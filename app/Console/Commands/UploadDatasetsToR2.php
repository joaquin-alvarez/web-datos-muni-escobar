<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Finder;

class UploadDatasetsToR2 extends Command
{
    protected $signature = 'datasets:upload-to-r2
                            {source? : Local directory containing dataset files (default: storage/app/public/datasets)}
                            {--dry-run : List files without uploading}';

    protected $description = 'Upload local dataset files to Cloudflare R2 bucket';

    public function handle(): int
    {
        $r2Url = config('filesystems.disks.r2.url');
        $r2Endpoint = config('filesystems.disks.r2.endpoint');

        if (!$r2Url || !$r2Endpoint) {
            $this->error('R2 is not configured. Set CLOUDFLARE_R2_* env variables first.');
            return self::FAILURE;
        }

        $source = $this->argument('source')
            ?? storage_path('app/public/datasets');

        if (!is_dir($source)) {
            $this->error("Source directory does not exist: {$source}");
            $this->info('Place your dataset files in that directory first, organized as:');
            $this->info('  datasets/<dataset-slug>/<filename.ext>');
            return self::FAILURE;
        }

        $disk = Storage::disk('r2');
        $finder = new Finder();
        $finder->files()->in($source);

        $count = iterator_count($finder);
        $this->info("Found {$count} files in {$source}");

        if ($count === 0) {
            $this->warn('No files to upload.');
            return self::SUCCESS;
        }

        $bar = $this->output->createProgressBar($count);
        $bar->start();

        $uploaded = 0;
        $skipped = 0;

        foreach ($finder as $file) {
            $relativePath = 'datasets/' . ltrim(
                str_replace($source, '', $file->getRealPath()),
                DIRECTORY_SEPARATOR
            );

            if ($this->option('dry-run')) {
                $this->newLine();
                $this->line("  [DRY-RUN] {$relativePath} ({$this->formatBytes($file->getSize())})");
                $bar->advance();
                continue;
            }

            if ($disk->exists($relativePath)) {
                $skipped++;
                $bar->advance();
                continue;
            }

            $disk->put($relativePath, file_get_contents($file->getRealPath()));
            $uploaded++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        if ($this->option('dry-run')) {
            $this->info("Dry run complete. {$count} files would be uploaded.");
        } else {
            $this->info("Upload complete: {$uploaded} uploaded, {$skipped} skipped (already exist).");
            $this->info("Public URL base: {$r2Url}");
        }

        return self::SUCCESS;
    }

    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}

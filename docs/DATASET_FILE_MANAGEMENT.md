# Dataset File Management Guide

This guide explains how to manage dataset files directly from the Filament dashboard.

## Overview

Dataset files are stored in Cloudflare R2 bucket and can be fully managed through the Filament admin panel. The system supports uploading, editing, downloading, and deleting files without needing external tools or command-line operations.

## Features

### File Upload
- **Drag-and-drop interface**: Upload files by dragging them into the upload area
- **Multiple formats supported**: GeoJSON, Shapefile (.shp), Excel (.xlsx), CSV, KML, DBF, ZIP
- **Automatic R2 storage**: Files are automatically uploaded to the configured R2 bucket
- **File validation**: Maximum file size of 50MB per file
- **Automatic URL generation**: Public URLs are generated automatically using R2 public domain

### File Management
- **View all files**: See all files associated with a dataset in the Files tab
- **Download files**: One-click download from the dashboard
- **Edit file metadata**: Update file names and replace files
- **Delete files**: Remove files from both database and R2 bucket
- **Bulk operations**: Delete multiple files at once

### File Information
- **Format badge**: Visual indicator of file format
- **File size**: Human-readable file size (B, KB, MB, GB)
- **Upload timestamp**: Date and time when file was uploaded
- **Public URL**: Copyable URL for direct access to the file

## How to Use

### Accessing File Management

1. Navigate to **Datos Abiertos > Datasets** in the admin panel
2. Click on a dataset to edit it
3. Click on the **Archivos del Dataset** tab

### Uploading a New File

1. Click the **Subir archivo** button
2. Select the **Formato** (file format) from the dropdown
3. Either:
   - Drag and drop a file into the upload area, OR
   - Click to browse and select a file
4. The file name will be automatically filled
5. Click **Crear** to upload the file

### Editing a File

1. Click the **edit icon** (pencil) next to the file you want to edit
2. Update the file name if needed
3. To replace the file, upload a new file (the old file will be deleted from R2)
4. Click **Guardar** to save changes

### Downloading a File

1. Click the **Descargar** button (download icon) next to the file
2. The file will open in a new tab or download to your computer

### Deleting a File

1. Click the **delete icon** (trash) next to the file you want to remove
2. Confirm the deletion
3. The file will be removed from both the database and the R2 bucket

### Bulk Deletion

1. Select multiple files using the checkboxes
2. Click the bulk actions dropdown at the top of the table
3. Select **Delete selected**
4. Confirm the deletion
5. All selected files will be removed from database and R2

## File Storage Structure

Files are organized in R2 using the following structure:

```
datasets/
  └── {dataset-slug}/
      ├── file1.geojson
      ├── file2.shp
      └── file3.xlsx
```

## Supported File Types

- **GeoJSON**: `.geojson`
- **Shapefile**: `.shp`, `.dbf`
- **Excel**: `.xlsx`, `.xls`
- **CSV**: `.csv`
- **KML**: `.kml`
- **ZIP**: `.zip` (for bundled shapefiles)

## File URL Format

Files are accessible via public URLs with the following format:

```
https://{R2_PUBLIC_DOMAIN}/datasets/{dataset-slug}/{filename}
```

Example:
```
https://pub-xxx.r2.dev/datasets/centros-de-salud/Centros_de_salud.geojson
```

## Important Notes

- **File size limit**: Maximum 50MB per file (can be adjusted in FilesRelationManager)
- **Automatic deletion**: When you delete a file from the dashboard, it's automatically removed from R2
- **File replacement**: When editing a file and uploading a new one, the old file is automatically deleted from R2
- **R2 configuration required**: Ensure `CLOUDFLARE_R2_*` environment variables are properly configured
- **Public access**: All uploaded files are publicly accessible via the R2 URL

## Troubleshooting

### Upload Fails
- Check that R2 credentials are correctly configured in `.env`
- Verify the file size is under 50MB
- Ensure the file type is supported

### File Not Accessible
- Verify the R2 bucket is configured for public access
- Check that `CLOUDFLARE_R2_URL` points to the correct public domain
- Ensure the file was successfully uploaded (check the file URL in the table)

### Deletion Fails
- Verify R2 write permissions are configured
- Check that the file path in the database matches the R2 structure
- Review Laravel logs for specific error messages

## Technical Details

### Database Schema

Files are stored in the `dataset_format` pivot table with the following structure:

| Column | Type | Description |
|--------|------|-------------|
| dataset_id | Foreign Key | Reference to dataset |
| format_id | Foreign Key | Reference to format |
| file_name | String | Original filename |
| file_url | String | Full public URL to file |
| file_size | Integer | File size in bytes |
| created_at | Timestamp | Upload timestamp |
| updated_at | Timestamp | Last update timestamp |

### Implementation Files

- `app/Filament/Resources/DatasetResource/RelationManagers/FilesRelationManager.php`: Main file management interface
- `app/Filament/Resources/DatasetResource.php`: Dataset resource with files relation
- `config/filesystems.php`: R2 disk configuration
- `database/migrations/2024_01_01_000004_create_dataset_format_table.php`: Pivot table schema

#!/bin/bash
# Wrapper script to convert .docx files to .md using the virtual environment

# Get the directory where this script is located
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# Activate the virtual environment and run the Python script
source "$SCRIPT_DIR/.venv/bin/activate"
python "$SCRIPT_DIR/archive/convert_docx_to_md.py" "$@"

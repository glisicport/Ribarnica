import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import fs from 'fs';
import path from 'path';

// recursively find all files in a directory
function getFiles(dir, ext = null) {
    return fs.readdirSync(dir)
        .flatMap(file => {
            const fullPath = path.join(dir, file);

            if (fs.statSync(fullPath).isDirectory()) {
                return getFiles(fullPath, ext);
            }

            // filter by extension if provided
            if (ext && !fullPath.endsWith(ext)) {
                return [];
            }

            return fullPath;
        });
}

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...getFiles('resources/js', '.js'),
                ...getFiles('resources/css', '.css')
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});

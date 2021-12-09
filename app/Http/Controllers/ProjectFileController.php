<?php

namespace App\Http\Controllers;

use App\Models\ProjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectFile  $projectFile
     * @return \Illuminate\Http\Response
     */
    public function download(ProjectFile $projectFile)
    {
        return Storage::download($projectFile->path, $projectFile->name);
    }
}

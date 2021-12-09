<?php

namespace App\Http\Controllers;

use App\Models\ProposalFile;
use Illuminate\Support\Facades\Storage;

class ProposalFileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProposalFile  $proposalFile
     * @return \Illuminate\Http\Response
     */
    public function download(ProposalFile $proposalFile)
    {
        return Storage::download($proposalFile->path, $proposalFile->name);
    }
}

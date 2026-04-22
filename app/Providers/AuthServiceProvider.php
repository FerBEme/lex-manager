<?php
namespace App\Providers;
use App\Models\CaseFile;
use App\Models\File;
use App\Models\Folder;
use App\Policies\CaseFilePolicy;
use App\Policies\FilePolicy;
use App\Policies\FolderPolicy;
use Illuminate\Support\ServiceProvider;
class AuthServiceProvider extends ServiceProvider {    
    protected $policies = [
        CaseFile::class => CaseFilePolicy::class,
        Folder::class => FolderPolicy::class,
        File::class => FilePolicy::class,
    ];
    public function boot(): void {
        //
    }
}

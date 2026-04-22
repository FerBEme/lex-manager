<?php
namespace App\Providers;
use App\Models\CaseFile;
use App\Policies\CaseFilePolicy;
use Illuminate\Support\ServiceProvider;
class AuthServiceProvider extends ServiceProvider {    
    protected $policies = [
        CaseFile::class => CaseFilePolicy::class,
    ];
    public function boot(): void {
        //
    }
}

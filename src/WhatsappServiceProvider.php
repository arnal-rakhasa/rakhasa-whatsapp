<?php

namespace Rakhasa\Whatsapp;

use Spatie\LaravelPackageTools\Package;
use Rakhasa\Whatsapp\Commands\WhatsappCommand;
use Rakhasa\Whatsapp\WhatsappEventServiceProvider;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WhatsappServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('whatsapp')
            ->hasRoute('web')
            ->hasConfigFile('rakhasa-whatsapp')
            ->hasMigration('create_whatsapp_hosts_table')
            ->hasMigration('create_whatsapp_proxies_table')
            ->hasMigration('create_whatsapp_sessions_table')
            ->hasCommand(WhatsappCommand::class);
    }

    public function registeringPackage()
    {
        $this->app->register(WhatsappEventServiceProvider::class);
    }
}

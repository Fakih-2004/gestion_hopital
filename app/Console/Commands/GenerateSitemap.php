<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    // اسم الأمر اللي غيظهر فـ terminal
    protected $signature = 'sitemap:generate';

    // الوصف ديالو
    protected $description = 'Génère le fichier sitemap.xml pour le site';

    public function handle()
    {
        // إنشاء sitemap جديد
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0))
            ->add(Url::create('/patients')->setPriority(0.8))
            ->add(Url::create('/medecins')->setPriority(0.8))
            ->add(Url::create('/rendez-vous')->setPriority(0.7))
            ->add(Url::create('/contact')->setPriority(0.5));

        // حفظ الملف فـ مجلد public
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap généré avec succès dans /public/sitemap.xml');
    }
}

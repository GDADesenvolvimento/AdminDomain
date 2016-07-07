# GDA Admin - Domain

## Instruções

Esse pacote é para adicionar a função Domain(Domínios) na aplicação GDA Admin

## Instalação

composer require gdadesenv/admindomain

Adicione o seguinte service provider em seu arquivo config/app.php:

```php
'providers' => [
    //...
    GdaDesenv\AdminDomain\Providers\GdaDomainServiceProvider::class
]
```

Adicione o seguinte código ao arquivo resources/views/sidebar.blade.php:

```php
<li class="{{ setActiveMenu('domain') }}">
  <a href="{{route('domains')}}">
    <i class="fa fa-globe"></i> <span>Domínios</span>
  </a>
</li>
```

Rode o seguinte comando no artisan:

```bash
php artisan vendor:publish
```

Rode as migrações

```bash
php artisan migration
```

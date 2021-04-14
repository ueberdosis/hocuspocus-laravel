# hocuspocus-laravel

> Integrates hocuspocus into Laravel with a few clicks

## Installation

You can install the package via composer:

```bash
composer require ueberdosis/hocuspocus-laravel
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Ueberdosis\HocuspocusLaravel\HocuspocusLaravelServiceProvider" --tag="hocuspocus-laravel-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Ueberdosis\HocuspocusLaravel\HocuspocusLaravelServiceProvider" --tag="hocuspocus-laravel-config"
```

## Usage

Add the `CanCollaborate` trait to your user model:

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ueberdosis\HocuspocusLaravel\Traits\CanCollaborate;

class User extends Authenticatable {
    use CanCollaborate;
}
```

Add the `Collaborative` interface and `IsCollaborative` trait to your documents and configure the `collaborativeAttributes`:

```php
use Illuminate\Database\Eloquent\Model;
use Ueberdosis\HocuspocusLaravel\Contracts\Collaborative;
use Ueberdosis\HocuspocusLaravel\Traits\IsCollaborative;

class TextDocument extends Model implements Collaborative {
    use IsCollaborative;
    
    protected array $collaborativeAttributes = [
        'title', 'body',
    ];
}
```

In the frontend, add the `collaborationAccessToken` and `collaborationDocumentName` to your WebsocketProvider:

```blade
<script>
    window.collaborationAccessToken = '{{ optional(auth()->user())->getCollaborationAccessToken() }}';
    window.collaborationDocumentName = '{{ $yourTextDocument->getCollaborationDocumentName() }}'
</script>
```

```typescript
import * as Y from 'yjs'
import { WebsocketProvider } from 'y-websocket'

const doc = new Y.Doc()
const wsProvider = new WebsocketProvider('ws://localhost:1234', collaborationDocumentName, doc, {
    params: { access_token: collaborationAccessToken },
})
```

Configure a random secret key in your `.env`:

```dotenv
HOCUSPOCUS_SECRET="459824aaffa928e05f5b1caec411ae5f"
```

Finally setup hocuspocus with the webhook extension:

```typescript
import { Server } from '@hocuspocus/server'
import { Webhook, Events } from '@hocuspocus/extension-webhook'
import { TiptapTransformer } from '@hocuspocus/transformer'

const server = Server.configure({
  extensions: [
    new Webhook({
      // url to your application
      url: 'https://example.com/api/documents',
      // the same secret you configured earlier in your .env  
      secret: '459824aaffa928e05f5b1caec411ae5f',
        
      transformer: TiptapTransformer,
    }),
  ],
})

server.listen()
```

## Credits

- [Kris Siepert](https://github.com/kriskbx)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

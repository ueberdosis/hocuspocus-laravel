# Hocuspocus for Laravel
Seamlessly integrates a [Hocuspocus](https://www.hocuspocus.dev) backend with Laravel.

## Installation
You can install the package via composer:

```bash
composer require ueberdosis/hocuspocus-laravel
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Hocuspocus\HocuspocusServiceProvider" --tag="hocuspocus-laravel-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Hocuspocus\HocuspocusServiceProvider" --tag="hocuspocus-laravel-config"
```

## Usage

Add the `CanCollaborate` trait to your user model:

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hocuspocus\Traits\CanCollaborate;

class User extends Authenticatable {
    use CanCollaborate;
}
```

Add the `Collaborative` interface and `IsCollaborative` trait to your documents and configure the `collaborativeAttributes`:

```php
use Illuminate\Database\Eloquent\Model;
use Hocuspocus\Contracts\Collaborative;
use Hocuspocus\Traits\IsCollaborative;

class TextDocument extends Model implements Collaborative {
    use IsCollaborative;

    protected array $collaborativeAttributes = [
        'title', 'body',
    ];
}
```

Add policies to your app that handle authorization for your models. The name of the policy method is configurable inside the `hocuspocus-laravel.php` config file. An example:

```php
use App\Models\TextDocument;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TextDocumentPolicy
{
    use HandlesAuthorization;

    public function update(User $user, TextDocument $document)
    {
        return true;
    }
}
```

In the frontend, add the `collaborationAccessToken` and `collaborationDocumentName` to your WebSocket provider:

```blade
<script>
  window.collaborationAccessToken = '{{ optional(auth()->user())->getCollaborationAccessToken() }}';
  window.collaborationDocumentName = '{{ $yourTextDocument->getCollaborationDocumentName() }}'
</script>
```

```js
import { HocuspocusProvider } from '@hocuspocus/provider'
import * as Y from 'yjs'

const provider = new HocuspocusProvider({
  document: new Y.Doc(),
  url: 'ws://localhost:1234',
  name: window.collaborationDocumentName,
  parameters: {
    access_token: window.collaborationAccessToken,
  },
})
```

Configure a random secret key in your `.env`:

```dotenv
HOCUSPOCUS_SECRET="459824aaffa928e05f5b1caec411ae5f"
```

Finally set up Hocuspocus with the webhook extension:

```js
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
- [Hans Pagel](https://github.com/hanspagel)
- [Kris Siepert](https://github.com/kriskbx)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

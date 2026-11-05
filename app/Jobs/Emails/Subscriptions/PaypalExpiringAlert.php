<?php

namespace App\Jobs\Emails\Subscriptions;

use App\Enums\UserAction;
use App\Facades\UserLogger;
use App\Mail\Subscription\User\PaypalExpiringMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PaypalExpiringAlert implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected int $userId;

    public function __construct(User $user)
    {
        $this->userId = $user->id;
    }

    public function handle(): void
    {
        /** @var User|null $user */
        $user = User::find($this->userId);
        if (empty($user)) {
            return;
        }

        if ( config('app.email_enabled') )
        {
            try {
                Mail::to($user->email)
                    ->locale($user->locale)
                    ->send(new PaypalExpiringMail($user));
            } catch (\GuzzleHttp\Exception\ServerException $e) {
                // Silence
            } catch (TransportExceptionInterface $e) {
                // Mail isn't configured or the server is unreachable. This is allowed, so don't rethrow.
                Log::warning('Paypal expired email not sent: ' . $e->getMessage());
            } catch (Exception $e) {
                // Something went wrong with mailgun, or the email is invalid. Silence these errors
                // to avoid spamming sentry.
                Log::error('Paypal expired email not sent: ' . $e->getMessage());
            }
        }

        UserLogger::user($user)->log(UserAction::subPaypalExpiringWarning);
    }
}

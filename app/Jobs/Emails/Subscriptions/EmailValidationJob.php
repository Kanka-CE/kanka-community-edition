<?php

namespace App\Jobs\Emails\Subscriptions;

use App\Mail\Subscription\User\ValidationEmail;
use App\Models\User;
use App\Models\UserValidation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailValidationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected int $user;

    protected int $token;

    public function __construct(User $user, UserValidation $token)
    {
        $this->user = $user->id;
        $this->token = $token->id;
    }

    /**
     * @throws BindingResolutionException
     */
    public function handle()
    {
        // Small check in case the user deleted their account before the queue could get to them
        /** @var User|null $user */
        $user = User::find($this->user);
        if (empty($user)) {
            return;
        }
        $userValidation = UserValidation::find($this->token);
        $url = route('validation.email', ['userValidation' => $userValidation]);

        if ( config('app.email_enabled') )
        {
            try {
                Mail::to($user->email)
                    ->locale($user->locale)
                    ->send(
                        new ValidationEmail($user, $url)
                    );
            } catch (\GuzzleHttp\Exception\ServerException $e) {
                // Silence
            } catch (TransportExceptionInterface $e) {
                // Mail isn't configured or the server is unreachable. This is allowed, so don't rethrow.
                Log::warning('Email validation email not sent: ' . $e->getMessage());
            } catch (Exception $e) {
                // Something went wrong with mailgun, or the email is invalid. Silence these errors
                // to avoid spamming sentry.
                Log::error('Email validation email not sent: ' . $e->getMessage());
            }
        }
    }
}

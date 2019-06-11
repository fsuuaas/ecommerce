<?php

namespace App\Handlers\Events;

use app\Antony\DomainLogic\Modules\Audit\Trail;
use App\Events\UserWasLoggedIn;
use App\Models\User;
use Carbon\Carbon;

class LogUserEvent
{
    /**
     * @var Trail
     */
    private $trail;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Trail $trail)
    {
        //
        $this->trail = $trail;
    }

    /**
     * Handle the event.
     *
     * @param UserWasLoggedIn $event
     *
     * @return bool
     */
    public function handle(User $user)
    {
        return $this->updateLoginTime($user);
    }

    /**
     * @return mixed
     */
    public function updateLoginTime($user)
    {
        $user->last_login = Carbon::now();

        return $user->save();
    }

    public function updateAuditTrail()
    {

        // save the event name in the DB if it doesn't exist
    }
}

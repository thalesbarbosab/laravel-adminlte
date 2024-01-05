<?php

namespace App\Services\Notification;

use App\Models\Notification;

class NotificationService
{
    public function getAll() : iterable
    {
        return Notification::orderBy('created_at', 'desc')->get();
    }

    public function getAllPaginated(int $items_per_page = 10) : iterable
    {
        return Notification::orderBy('created_at', 'desc')
                           ->paginate($items_per_page);
    }

    public function getAllUnreaded() : iterable
    {
        return Notification::whereReaded(false)
                           ->orderBy('created_at', 'desc')
                           ->get();
    }

    public function updateAllUnreadedToReaded() : void
    {
        $notificacoes = $this->getAllUnreaded();
        foreach($notificacoes as $notification) {
            $notification->update(['readed'=>true]);
        }
    }
}

<?php

namespace App\Services\AdminLTE;

use Illuminate\Support\Str;

class NotificationAdminLteService
{
    /**
     * @param iterable<\App\Models\Notification> $notifications
     */
    public function getHtmlNotifications($notifications) : array
    {

        $dropdown_html = '';

        foreach ($notifications as $key => $notification) {
            $text = Str::limit($notification->text, 15);
            $icon = "<i class='mr-2 {$notification->icon}'></i>";

            $time = "<span class='float-right text-muted text-sm'>
                    {$notification->created_at->diffForHumans()}
                    </span>";

            $dropdown_html .= "<a class='dropdown-item' href='".config('adminlte.menu.0.url')."'>
                            {$icon}{$text}{$time}
                            </a>";

            if ($key < count($notifications) - 1) {
                $dropdown_html .= "<div class='dropdown-divider'></div>";
            }
        }

        // Return the new notification data.

        return [
            'label'       => count($notifications),
            'label_color' => 'danger',
            'icon_color'  => 'default',
            'dropdown'    => $dropdown_html,
        ];
    }
}

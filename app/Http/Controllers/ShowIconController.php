<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Icon;

final class ShowIconController
{
    public function __invoke(Icon $icon, bool $download = false)
    {
        if ($download) {
            return response(svg($icon->name)->toHtml())
                ->header('Content-Type', 'image/svg+xml')
                ->header('Content-disposition', sprintf('attachment; filename="%s.svg"', $icon->name));
        }

        return view('blade-icons.show', [
            'icon' => $icon,
            'icons' => Icon::relatedIcons($icon),
        ]);
    }
}

<?php

namespace App\Enums;

enum EnumSearchMemorialWith: string
{
    case GPS = 'with-gps';
    case PLOT = 'with-plot';
    case NO_GPS = 'with-no-gps';
    case PLOT_INFO = 'with-plot-info';
    case GRAVE_PHOTO = 'with-grave-photo';
    case NO_GRAVE_PHOTO = 'with-no-grave-photo';
}

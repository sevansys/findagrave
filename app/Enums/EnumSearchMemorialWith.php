<?php

namespace App\Enums;

enum EnumSearchMemorialWith: string
{
    case GPS = 'with-gps';
    case NO_GPS = 'without-gps';
    case PLOT_INFO = 'with-plot-info';
    case NO_PLOT_INFO = 'without-plot-info';
    case GRAVE_PHOTO = 'with-grave-photo';
    case NO_GRAVE_PHOTO = 'without-grave-photo';
}

@props([
  'value' => 0,
])

<span class="progress progress--svg inline-flex" style="--svg-progress-size: {{ $sizeValue }}">
  <svg width="100%" height="100%" viewBox="-31.25 -31.25 312.5 312.5" xmlns="http://www.w3.org/2000/svg" style="transform:rotate(-90deg)">
    <circle r="115" cx="125" cy="125" fill="transparent" stroke="{{ $placeholderColor }}" stroke-width="{{ $strokeWidth }}" stroke-dasharray="722.2px" stroke-dashoffset="0"></circle>
    <circle r="115" cx="125" cy="125" stroke="{{ $value ? $color : $placeholderColor }}" stroke-width="{{ $strokeWidth }}" stroke-linecap="round" stroke-dashoffset="{{ 722.2 - ($value * 722.2 / 100) }}px" fill="transparent" stroke-dasharray="722.2px"></circle>
    <text x="95px" y="140px" fill="{{ $color }}" font-size="52px" font-weight="bold" style="transform:rotate(90deg) translate(0px, -246px)">28</text>
  </svg>
</span>


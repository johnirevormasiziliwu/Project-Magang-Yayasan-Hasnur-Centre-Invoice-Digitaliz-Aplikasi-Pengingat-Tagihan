@props(['value'])

<label {{ $attributes->merge(['class' => 'font-inter font-bold text-2xl leading-8 mb-5 text-[#404040]']) }}>
    {{ $value ?? $slot }}
</label>

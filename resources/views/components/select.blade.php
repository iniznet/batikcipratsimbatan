<select {{ $attributes->twMerge(['class' => 'w-full rounded-full border border-[#e6e9f0] px-2 py-2 focus:outline-none focus:ring-2 focus:ring-[#006ce2]']) }}>
  @foreach ($options as $option)
    <option value="{{ $option['value'] }}" {{ $selected === $option['value'] ? 'selected="selected"' : '' }}>{{ $option['label'] }}</option>
  @endforeach
</select>

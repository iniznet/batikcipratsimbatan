<label>
  <input type="checkbox" {{ $attributes->merge(['class' => 'rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50']) }}>
  <span class="ml-2">{{ $slot }}</span>
</label>

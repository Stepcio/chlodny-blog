@php
    $field = 'block w-full rounded-lg border border-stone-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-400';
    $label = 'block text-sm font-medium text-stone-600 mb-1';
@endphp

<div>
    <label for="name" class="{{ $label }}">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $shop->name) }}" required class="{{ $field }}">
    @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label for="district" class="{{ $label }}">District</label>
        <input type="text" name="district" id="district" value="{{ old('district', $shop->district) }}" class="{{ $field }}">
        @error('district') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="address" class="{{ $label }}">Address</label>
        <input type="text" name="address" id="address" value="{{ old('address', $shop->address) }}" class="{{ $field }}">
        @error('address') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label for="description" class="{{ $label }}">Short description (shown on cards)</label>
    <textarea name="description" id="description" rows="2" required class="{{ $field }}">{{ old('description', $shop->description) }}</textarea>
    @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label for="body" class="{{ $label }}">Full review / blog entry</label>
    <textarea name="body" id="body" rows="6" class="{{ $field }}">{{ old('body', $shop->body) }}</textarea>
    @error('body') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div>
        <label for="status" class="{{ $label }}">Status</label>
        <select name="status" id="status" class="{{ $field }}">
            <option value="want_to_visit" @selected(old('status', $shop->status) === 'want_to_visit')>Want to visit</option>
            <option value="visited" @selected(old('status', $shop->status) === 'visited')>Visited</option>
        </select>
        @error('status') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="rating" class="{{ $label }}">Rating</label>
        <select name="rating" id="rating" class="{{ $field }}">
            <option value="">—</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" @selected((string) old('rating', $shop->rating) === (string) $i)>{{ $i }}</option>
            @endfor
        </select>
        @error('rating') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="visited_at" class="{{ $label }}">Visited on</label>
        <input type="date" name="visited_at" id="visited_at" value="{{ old('visited_at', optional($shop->visited_at)->format('Y-m-d')) }}" class="{{ $field }}">
        @error('visited_at') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label for="website" class="{{ $label }}">Website</label>
    <input type="url" name="website" id="website" value="{{ old('website', $shop->website) }}" placeholder="https://" class="{{ $field }}">
    @error('website') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label for="cover_image" class="{{ $label }}">Cover photo</label>
    @if ($shop->cover_image)
        <img src="{{ asset('storage/'.$shop->cover_image) }}" alt="{{ $shop->name }}" class="h-24 rounded-lg object-cover mb-2">
    @endif
    <input type="file" name="cover_image" id="cover_image" accept="image/*" class="{{ $field }}">
    @error('cover_image') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<label class="flex items-center gap-2 text-sm text-stone-600">
    <input type="checkbox" name="is_featured" value="1" class="rounded border-stone-300" @checked(old('is_featured', $shop->is_featured))>
    Include in Rankings
</label>

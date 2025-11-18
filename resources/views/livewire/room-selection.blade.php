<div>
    <div class="xl:col-span-6">
        <label for="ceeSession" class="inline-block mb-2 text-base font-medium">USMCEE Batch
            <span class="text-red-500">*</span></label>
        <select wire:model="ceeSession" class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
            <option value="">-Select Examination Session-</option>
            <option value="Batch 1">Batch 1 (6:00 AM - 9:00 AM)</option>
            <option value="Batch 2">Batch 2 (10:00 AM - 1:00 PM)</option>
            <option value="Batch 3">Batch 3 (2:00 PM - 5:00 PM)</option>
        </select>
    </div>

    <div class="xl:col-span-6">
        <label for="room" class="inline-block mb-2 text-base font-medium">Room Assignment
            <span class="text-red-500">*</span></label>
        <select wire:model="selectedRoom" name="room" class="form-input border-slate-300 focus:outline-none focus:border-custom-500">
            <option selected disabled>Choose Room</option>
            @foreach($rooms as $room)
                <option value="{{ $room['id'] }}">
                    {{ $room['room_name'] }} - {{ $room['college_name'] }} - (Slots: {{ $room['capacity'] }})
                </option>
            @endforeach
        </select>
        @if($errorMessage)
            <div class="text-red-500 mt-2">
                {{ $errorMessage }}
            </div>
        @endif
    </div>
</div>

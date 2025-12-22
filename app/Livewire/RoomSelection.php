<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;

class RoomSelection extends Component
{
    public $ceeSession;
    public $selectedRoom;
    public $rooms = [];
    public $errorMessage = ''; // Property to store error message

    // Update rooms when ceeSession is updated
    public function updatedCeeSession()
    {
        if ($this->ceeSession) {
            // Fetch rooms based on the selected session
            $this->rooms = Room::where('exam_session', $this->ceeSession)
                ->get(['id', 'room_name', 'college_name', 'capacity'])
                ->toArray();

            // Check if no rooms were found and set an error message
            if (empty($this->rooms)) {
                $this->errorMessage = "No rooms found for the selected session.";
            } else {
                $this->errorMessage = ''; // Clear error message if rooms are found
            }
        } else {
            $this->rooms = [];
            $this->errorMessage = '';
        }
    }

    public function render()
    {
        return view('livewire.room-selection');
    }
}

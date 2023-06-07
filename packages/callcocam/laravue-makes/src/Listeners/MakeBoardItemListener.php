<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Makes\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class MakeBoardItemListener
{
    protected $request;
    /**
     * Create the event listener.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($options = $this->request->input('options')) {
            $data = json_decode($options, true);
            if ($data) {
                foreach ($data as $name => $val) {
                    $event->make_board_items_options()->create([
                        'name' => $name,
                        'description' => $val,
                    ]);
                }
            }
        }
    }
}

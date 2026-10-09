<?php

namespace App\Http\Controllers;

class GameController extends Controller
{
    // The Mind exercises (only reaction + number are playable)
    private array $mindGames = [
        ['id' => 'reaction', 'mark' => '>|',   'name' => 'Reaction Time',   'desc' => 'How fast do your eyes talk to your hands?', 'playable' => true],
        ['id' => 'sequence', 'mark' => '▣',    'name' => 'Sequence Memory', 'desc' => 'Repeat a pattern that keeps growing.', 'playable' => true],
        ['id' => 'aim',      'mark' => '◎',    'name' => 'Aim Trainer',     'desc' => 'Clear thirty targets as fast as you can.'],
        ['id' => 'number',   'mark' => '123',  'name' => 'Number Memory',   'desc' => 'Hold the longest digit string you can.', 'playable' => true],
        ['id' => 'verbal',   'mark' => 'A',    'name' => 'Verbal Memory',   'desc' => 'Tell words you have seen from new ones.'],
        ['id' => 'chimp',    'mark' => '4·2',  'name' => 'Chimp Test',      'desc' => 'Tap a scattered grid in numeric order.'],
        ['id' => 'visual',   'mark' => '▦',    'name' => 'Visual Memory',   'desc' => 'Recall a widening board of lit tiles.'],
        ['id' => 'typing',   'mark' => 'wpm',  'name' => 'Typing',          'desc' => 'Words per minute, one clean pass.'],
        ['id' => 'reading',  'mark' => '🗣', 'name' => 'Reading',        'desc' => 'Read out loud.'],
    ];

    private array $bodyGames = [
        ['id' => 'jump', 'mark' => '⤴', 'name' => 'Jump Rope', 'desc' => 'Jump, Jump, Jump!', 'playable' => true],
    ];

    public function home()
    {
        return view('baseline.home');
    }

    public function mind()
    {
        return view('baseline.list', [
            'title' => 'Mind',
            'blurb' => 'Eight screen Exercises. Reaction Time and Number Memory are live.',
            'games' => $this->mindGames,
        ]);
    }

    public function body()
    {
        return view('baseline.list', [
            'title' => 'Body',
            'blurb' => 'Stand up for this one. Jump Rope is live.',
            'games' => $this->bodyGames,
        ]);
    }

    public function game(string $id)
    {
        $all = array_merge($this->mindGames, $this->bodyGames);
        $game = collect($all)->firstWhere('id', $id);

        // Unknown id -> back to mind
        if (! $game) {
            return redirect('/mind');
        }

        // Playable games have their own view; the rest show a "coming soon" stub
        $playable = $game['playable'] ?? false;
        $category = collect($this->bodyGames)->firstWhere('id', $id) ? 'body' : 'mind';

        // non-playable games are not reachable — send back to the category list
        if (! $playable) {
            return redirect('/' . $category);
        }

        return view('baseline.games.' . $id, ['game' => $game, 'category' => $category]);
    }
}

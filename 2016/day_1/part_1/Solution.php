<?php

// --- Day 1: No Time for a Taxicab ---
// Santa's sleigh uses a very high-precision clock to guide its movements, and the clock's oscillator is regulated by stars. Unfortunately, the stars have been stolen... by the Easter Bunny. To save Christmas, Santa needs you to retrieve all fifty stars by December 25th.

// Collect stars by solving puzzles. Two puzzles will be made available on each day in the Advent calendar; the second puzzle is unlocked when you complete the first. Each puzzle grants one star. Good luck!

// You're airdropped near Easter Bunny Headquarters in a city somewhere. "Near", unfortunately, is as close as you can get - the instructions on the Easter Bunny Recruiting Document the Elves intercepted start here, and nobody had time to work them out further.

// The Document indicates that you should start at the given coordinates (where you just landed) and face North. Then, follow the provided sequence: either turn left (L) or right (R) 90 degrees, then walk forward the given number of blocks, ending at a new intersection.

// There's no time to follow such ridiculous instructions on foot, though, so you take a moment and work out the destination. Given that you can only walk on the street grid of the city, how far is the shortest path to the destination?

// For example:

// Following R2, L3 leaves you 2 blocks East and 3 blocks North, or 5 blocks away.
// R2, R2, R2 leaves you 2 blocks due South of your starting position, which is 2 blocks away.
// R5, L5, R5, R3 leaves you 12 blocks away.
// How many blocks away is Easter Bunny HQ?

class Solution

{
    public function run()
    {

        $inputs = file('puzzle_inputs.txt');
        // $inputs = file('test_puzzle_inputs.txt');


        // $inputs = trim($inputs[0]);
        $steps = explode(', ', $inputs[0]);
        // array_pop($steps);

        $chords = [
          'x' => 0,
          'y' => 0
        ];

        $orientations = [
           'N',
           'E',
           'S',
           'W',
        ];

        $orientation = 0;
        foreach ($steps as $key => $step) {
          $direction = $step[0];
          $distance =  intval(substr($step, 1, ));

          switch ($direction) {
            case 'R':
              if(($orientation === 3)){
                $orientation = 0;
              } else {
                $orientation++;
              }
              break;
            case 'L':
              if(($orientation === 0)){
                $orientation = 3;
              } else {
                $orientation--;
              }
              break;
          }

          switch ($orientations[$orientation]) {
            case 'N':
              $chords['y'] += $distance;
              break;
            case 'E':
              $chords['x'] += $distance;
              break;
            case 'S':
              $chords['y'] -= $distance;
              break;
            case 'W':
              $chords['x'] -= $distance;
              break;
          }
          echo  'orient: ' .$orientations[$orientation] . PHP_EOL;
          echo 'k: '. $key .  ' step: ' . $step . PHP_EOL;
          print_r($chords);
          // if($key == 3) die;
        }


        echo abs($chords['x']) + abs($chords['y']) . PHP_EOL;
        //  |X1 – X2| + |Y1 – Y2|.
    }

}


(new Solution())->run();

<?php


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

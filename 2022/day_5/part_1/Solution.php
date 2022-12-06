<?php
// --- Day 5: Supply Stacks ---
// The expedition can depart as soon as the final supplies have been unloaded from the ships. Supplies are stored in stacks of marked crates, but because the needed supplies are buried under many other crates, the crates need to be rearranged.

// The ship has a giant cargo crane capable of moving crates between stacks. To ensure none of the crates get crushed or fall over, the crane operator will rearrange them in a series of carefully-planned steps. After the crates are rearranged, the desired crates will be at the top of each stack.

// The Elves don't want to interrupt the crane operator during this delicate procedure, but they forgot to ask her which crate will end up where, and they want to be ready to unload them as soon as possible so they can embark.

// They do, however, have a drawing of the starting stacks of crates and the rearrangement procedure (your puzzle input). For example:

//     [D]
// [N] [C]
// [Z] [M] [P]
//  1   2   3

// move 1 from 2 to 1
// move 3 from 1 to 3
// move 2 from 2 to 1
// move 1 from 1 to 2
// In this example, there are three stacks of crates. Stack 1 contains two crates: crate Z is on the bottom, and crate N is on top. Stack 2 contains three crates; from bottom to top, they are crates M, C, and D. Finally, stack 3 contains a single crate, P.

// Then, the rearrangement procedure is given. In each step of the procedure, a quantity of crates is moved from one stack to a different stack. In the first step of the above rearrangement procedure, one crate is moved from stack 2 to stack 1, resulting in this configuration:

// [D]
// [N] [C]
// [Z] [M] [P]
//  1   2   3
// In the second step, three crates are moved from stack 1 to stack 3. Crates are moved one at a time, so the first crate to be moved (D) ends up below the second and third crates:

//         [Z]
//         [N]
//     [C] [D]
//     [M] [P]
//  1   2   3
// Then, both crates are moved from stack 2 to stack 1. Again, because crates are moved one at a time, crate C ends up below crate M:

//         [Z]
//         [N]
// [M]     [D]
// [C]     [P]
//  1   2   3
// Finally, one crate is moved from stack 1 to stack 2:

//         [Z]
//         [N]
//         [D]
// [C] [M] [P]
//  1   2   3
// The Elves just need to know which crate will end up on top of each stack; in this example, the top crates are C in stack 1, M in stack 2, and Z in stack 3, so you should combine these together and give the Elves the message CMZ.

// After the rearrangement procedure completes, what crate ends up on top of each stack?

class Solution

{
    public function run()
    {

        $inputs = file('puzzle_inputs.txt');
        $inputs = file('test_puzzle_inputs.txt');

        $container_stacks = [];
        foreach ($inputs as $key => $line) {

            $line_parts = str_split($line);

            // once we get to the stack numbers we can stop
            if (in_array('1', $line_parts)) {
                break;
            }
            foreach ($line_parts as $k2 => $char) {
                $container_stacks[$k2][] = $char;
            }
        }

        $final_parsed_stacks = [];
        foreach ($container_stacks as $k3 => $stack) {

            $letters_in_stack = array_intersect($stack, range('A', 'Z'));


            if (count($letters_in_stack) > 0) {
                krsort($letters_in_stack);
                $final_parsed_stacks[] = $letters_in_stack;
            }
        }


        print_r($final_parsed_stacks);

        // now we can do the moves

        $instructions = [];
        foreach ($inputs as $k => $line) {
            if ($line[0] !== 'm') {
                continue;
            }
            $line = trim($line);
            $l_parts = explode(' ', $line);
            $instructions[] = [
                'move_count' => $l_parts[1],
                'from' => $l_parts[3] - 1,
                'to' => $l_parts[5] - 1,
            ];
        }

        foreach ($instructions as $instruction) {
            // move count # of elements from 'from'
            for ($i = 0; $i < $instruction['move_count']; $i++) {
                $cont_to_move = array_pop($final_parsed_stacks[$instruction['from']]);
                array_push($final_parsed_stacks[$instruction['to']], $cont_to_move);
            }
        }


        $top_containers = '';
        foreach ($final_parsed_stacks as $final_order_stack) {
            $top_containers .= array_pop($final_order_stack);
        }

        echo $top_containers . PHP_EOL;
    }
}

(new Solution())->run();

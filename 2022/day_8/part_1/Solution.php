<?php
// --- Day 8: Treetop Tree House ---
// The expedition comes across a peculiar patch of tall trees all planted carefully in a grid. The Elves explain that a previous expedition planted these trees as a reforestation effort. Now, they're curious if this would be a good location for a tree house.

// First, determine whether there is enough tree cover here to keep a tree house hidden. To do this, you need to count the number of trees that are visible from outside the grid when looking directly along a row or column.

// The Elves have already launched a quadcopter to generate a map with the height of each tree (your puzzle input). For example:

// 30373
// 25512
// 65332
// 33549
// 35390
// Each tree is represented as a single digit whose value is its height, where 0 is the shortest and 9 is the tallest.

// A tree is visible if all of the other trees between it and an edge of the grid are shorter than it. Only consider trees in the same row or column; that is, only look up, down, left, or right from any given tree.

// All of the trees around the edge of the grid are visible - since they are already on the edge, there are no trees to block the view. In this example, that only leaves the interior nine trees to consider:

// The top-left 5 is visible from the left and top. (It isn't visible from the right or bottom since other trees of height 5 are in the way.)
// The top-middle 5 is visible from the top and right.
// The top-right 1 is not visible from any direction; for it to be visible, there would need to only be trees of height 0 between it and an edge.
// The left-middle 5 is visible, but only from the right.
// The center 3 is not visible from any direction; for it to be visible, there would need to be only trees of at most height 2 between it and an edge.
// The right-middle 3 is visible from the right.
// In the bottom row, the middle 5 is visible, but the 3 and 4 are not.
// With 16 trees visible on the edge and another 5 visible in the interior, a total of 21 trees are visible in this arrangement.

// Consider your map; how many trees are visible from outside the grid?
class Solution

{
    public function run()
    {

        $inputs = file('puzzle_inputs.txt');
        // $inputs = file('test_puzzle_inputs.txt');

        $max_index = strlen($inputs[0]) - 1;


        $rows = [];
        $cols = [];
        foreach ($inputs as $row => $raw_row) {
            $row_string = trim($raw_row);
            $rows[] = $row_string;
            for ($i = 0; $i < $max_index; $i++) {
                @$cols[$i] .= $row_string[$i];
            }
        }

        // -1 since we're using a 0 indexed array
        $edge_row_end = count($rows) - 1;
        $edge_row_start = 0;
        // count right and left looking in;
        $visible_rows = $this->getVisibleTreeCords(
            $rows,
            $edge_row_start,
            $edge_row_end
        );

        $visible = [];
        foreach ($visible_rows as $k1 => $visible_row) {
            $visible[$visible_row] = 1;
        }

        // count right and left looking in;
        $visible_cols = $this->getVisibleTreeCords(
            $cols,
            $edge_row_start,
            $edge_row_end,
            false
        );
        foreach ($visible_cols as $k2 => $visible_col) {
            $visible[$visible_col] = 1;
        }

        echo count($visible);

    }



    private function getVisibleTreeCords(
        array $lines_of_trees,
        int $edge_row_start,
        int $edge_row_end,
        bool $is_row = true
    ) {
        $start_and_end_tree_lines = [
            $edge_row_start,
            $edge_row_end,
        ];
        foreach ($lines_of_trees as $line_num => $tree_line) {

            $tree_line_parts = str_split($tree_line);
            $tree_line_parts_reversed = array_reverse($tree_line_parts);
            for ($i = 0; $i <= $edge_row_end; $i++) {
                // perimeter trees
                if (
                    in_array($line_num, $start_and_end_tree_lines)
                    || in_array($i, $start_and_end_tree_lines)
                ) {
                    yield $line_num . ',' . $i;
                    continue;
                }


                $trees_between_edge_right = array_slice($tree_line_parts, 0, $i);
                $trees_between_edge_left = array_slice($tree_line_parts_reversed, 0, $edge_row_end - $i);
                $can_see_right = max($trees_between_edge_right) < $tree_line[$i];
                $can_see_left = max($trees_between_edge_left) < $tree_line[$i];



                if ($can_see_right || $can_see_left) {
                    if ($is_row) {
                        yield $line_num . ',' . $i;
                        continue;
                    }
                    yield $i . ',' . $line_num;
                }
                continue;
            }
        }
    }
}
(new Solution())->run();

<?php
define("BAILOUT", 16);
define("MAX_ITERATIONS", 1000);

class Mandelbrot
{
    public function run()
    {
        $d1 = microtime(1);
        for ($y = -39; $y < 39; $y++) {
            for ($x = -39; $x < 39; $x++) {

                if ($this->iterate($x / 40.0, $y / 40.0) == 0)
                    echo("*");
                else
                    echo(" ");

            }
            echo("\n");
        }
        $d2 = microtime(1);
        return $d2 - $d1;
    }

    public function iterate($x, $y)
    {
        $cr = $y - 0.5;
        $ci = $x;
        $zr = 0.0;
        $zi = 0.0;
        $i = 0;
        while (true) {
            $i++;
            $temp = $zr * $zi;
            $zr2 = $zr * $zr;
            $zi2 = $zi * $zi;
            $zr = $zr2 - $zi2 + $cr;
            $zi = $temp + $temp + $ci;
            if ($zi2 + $zr2 > BAILOUT)
                return $i;
            if ($i > MAX_ITERATIONS)
                return 0;
        }

    }


}


ob_start();
$e = (new Mandelbrot())->run();
ob_end_clean();
echo "TEST: Mandelbrot", PHP_EOL;
echo 'PHP Version:', phpversion(), PHP_EOL;
echo sprintf("Time: %0.3f\n", $e), PHP_EOL;

$fp = fopen('/app/result.csv', 'a+');
fputcsv($fp, ["Mandelbrot", $_ENV['CONTAINER_IMAGE']?:PHP_VERSION, $e]);
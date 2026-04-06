<?php
/**
 * 从 JSON 数据生成 SkillSeeder.php
 */
$jsonFile = __DIR__ . '/skills_data.json';
$outFile = __DIR__ . '/database/seeders/SkillSeeder.php';

$skills = json_decode(file_get_contents($jsonFile), true);
if (!$skills) { die("Failed to read skills_data.json\n"); }

$lines = [];
$lines[] = '<?php';
$lines[] = '';
$lines[] = 'namespace Database\Seeders;';
$lines[] = '';
$lines[] = 'use App\Models\Skill;';
$lines[] = 'use Illuminate\Database\Seeder;';
$lines[] = '';
$lines[] = 'class SkillSeeder extends Seeder';
$lines[] = '{';
$lines[] = '    public function run(): void';
$lines[] = '    {';
$lines[] = "        \$skills = [";

foreach ($skills as $s) {
    $lines[] = '            [';
    foreach ($s as $key => $val) {
        if ($key === 'is_featured') {
            $lines[] = "                '{$key}' => " . ($val ? 'true' : 'false') . ",";
        } elseif (is_numeric($val)) {
            $lines[] = "                '{$key}' => {$val},";
        } else {
            // Escape for PHP single-quoted string
            $e = str_replace(["\\", "'"], ["\\\\", "\\'"], (string)$val);
            $lines[] = "                '{$key}' => '{$e}',";
        }
    }
    $lines[] = '            ],';
}

$lines[] = '        ];';
$lines[] = '';
$lines[] = '        foreach ($skills as $item) {';
$lines[] = "            Skill::create(\$item);";
$lines[] = '        }';
$lines[] = '    }';
$lines[] = '}';

file_put_contents($outFile, implode("\n", $lines) . "\n");
echo "Generated {$outFile} with " . count($skills) . " skills.\n";

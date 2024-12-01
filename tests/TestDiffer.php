<?php

namespace Php\Project\tests\TestDiffer;

use PHPUnit\Framework\TestCase;

use function Php\Project\src\Differ\genDiff;

class TestDiffer extends TestCase
{
    private string $fixturePath = __DIR__ . '/fixtures';

    private function getExpectedPath(string $formatter): string
    {
      return "{$this->fixturePath}/{$formatter}-expected.txt";
    }

    private function getFirstFilePath(string $fileType): string
    {
      return "{$this->fixturePath}/file1.{$fileType}";
    }

    private function getSecondFilePath(string $fileType): string
    {
      return "{$this->fixturePath}/file2.{$fileType}";
    }

    public function testDiff(
      string $formatter,
      string $firstFileType,
      string $secondFileType
    ): void {
      $diff = genDiff($this->getFirstFilePath($firstFileType), $this->getSecondFilePath($secondFileType), $formatter);

      $this->assertStringEqualsFile($this->getExpectedPath($formatter), $diff);    
    }


    public function dataProvider(): array
    {
      return [
        'stylish format, json - json' => [
          'stylish',
          'json',
          'json',
        ],
        'stylish format, yaml - json' => [
          'stylish',
          'yaml',
          'json'
        ],
        'plain format, yaml - yml' => [
          'plain',
          'yaml',
          'yml',
        ],
        'json format, json - json' => [
          'json',
          'json',
          'json',
        ],
        'json format, yaml - yml' => [
          'json',
          'yaml',
          'yml',
        ],
      ];
    }
}
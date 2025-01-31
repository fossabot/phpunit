<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\TestSuite;

use function sprintf;
use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;
use SebastianBergmann\CodeCoverage\CodeCoverage;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
final class Finished implements Event
{
    private Telemetry\Info $telemetryInfo;

    private string $name;

    private Result $result;

    private ?CodeCoverage $codeCoverage;

    public function __construct(Telemetry\Info $telemetryInfo, string $name, Result $result, ?CodeCoverage $codeCoverage)
    {
        $this->telemetryInfo = $telemetryInfo;
        $this->name          = $name;
        $this->result        = $result;
        $this->codeCoverage  = $codeCoverage;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function result(): Result
    {
        return $this->result;
    }

    public function codeCoverage(): ?CodeCoverage
    {
        return $this->codeCoverage;
    }

    public function asString(): string
    {
        $name = '';

        if (!empty($this->name)) {
            $name = sprintf(
                '(%s)',
                $this->name
            );
        }

        return sprintf(
            'Test Suite Finished %s',
            $name,
        );
    }
}

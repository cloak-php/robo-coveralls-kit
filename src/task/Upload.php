<?php

namespace cloak\robo\coveralls\task;

use coverallskit\Configuration;
use coverallskit\ReportBuilder;
use Robo\Task\Shared\TaskInterface;
use Robo\Result;
use Robo\Output;


class Upload implements TaskInterface
{

    use Output;

    private $builder;

    public function __construct($configPath)
    {
        $configuration = Configuration::loadFromFile($configPath);
        $this->builder = ReportBuilder::fromConfiguration($configuration);
    }

    public function run()
    {
        $report = $this->builder->build();
        $report->upload();

        $message = sprintf('Sent a file %s to coveralls.', $report->getName());
        $this->yell($message);

        return Result::success($this);
    }

}
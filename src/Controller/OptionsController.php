<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Console\Application;

class OptionsController extends AbstractController
{
    #[Route('/api/v1/options/clear_cache', name: 'app_options_clear_cache')]
    public function clearCache(KernelInterface $kernel): Response
    {
        $this->doCommand($kernel, 'cache:clear');

        return $this->json([
            'status' => 200,
            'payload' => 'Cache cleanup'
        ]);
    }

    #[Route('/api/v1/options/warmup_cache', name: 'app_options_warmup_cache')]
    public function warmupCache(KernelInterface $kernel): Response
    {
        $this->doCommand($kernel, 'cache:warmup');

        return $this->json([
            'status' => 200,
            'payload' => 'Cache warmup'
        ]);
    }

    private function doCommand($kernel, $command)
    {
        $env = $kernel->getEnvironment();

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => $command,
            '--env' => $env
        ));

        $output = new BufferedOutput();
        $application->run($input, $output);

        $content = $output->fetch();

        return new Response($content);
    }
}

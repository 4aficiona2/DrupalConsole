<?php
/**
 * @file
 * Contains \Drupal\AppConsole\Command\GeneratorCommandCommand.
 */

namespace Drupal\AppConsole\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Herrera\Phar\Update\Manager;
use Herrera\Phar\Update\Manifest;

class SelfUpdateCommand extends ContainerAwareCommand
{
  const DRUPAL_CONSOLE_MANIFEST = "http://drupalconsole.com/manifest.json";

  /**
   * {@inheritdoc}
   */
  protected function configure()
  {
    $this
      ->setName('self-update')
      ->setDescription($this->trans('command.self-update.description'))
      ->setHelp($this->trans('command.self-update.help'))
    ;
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $manager = new Manager(Manifest::loadFile(
      self::DRUPAL_CONSOLE_MANIFEST
    ));
    $manager->update($this->getApplication()->getVersion(), true);
    $output->writeln($this->trans('command.self-update.messages.success'));
  }
}

<?php

namespace Drupal\charts_api_example\Controller;

use Drupal\charts\Charts\ModuleSelector;
use Drupal\charts\Services\ChartsSettingsService;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ChartsApiExample extends ControllerBase implements ContainerInjectionInterface {
  private $chartSettings;

  public function __construct(ChartsSettingsService $chartSettings) {
    drupal_set_message(json_encode($chartSettings->getChartsSettings()));
    $this->chartSettings = $chartSettings->getChartsSettings();
  }

  public function display(){

    $library = $this->chartSettings['library'];
    drupal_set_message($library.' --- '.$this->chartSettings['type']);

    if ($library == 'google'){
      //$moduleSelector = new ModuleSelector($library, $categories, $seriesData, $options, $attachmentDisplayOptions, $variables, $chartId);
    }

    $element = [
      '#theme' => 'charts_api_example',
      '#test_var' => $this->t($library)
    ];
   // return $element;
  }
  public static function create(ContainerInterface $container){
    return new static(
      $container->get('charts.settings')
    );
  }
}
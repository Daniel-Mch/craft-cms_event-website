<?php
/**
 * Daniel module for Craft CMS 3.x
 *
 * x
 *
 * @link      www.x.com
 * @copyright Copyright (c) 2022 Daniel
 */

namespace modules\danielmodule\twigextensions;


use Craft;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use NumberFormatter;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    Daniel
 * @package   DanielModule
 * @since     1
 */
class DanielModuleTwigExtension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'DanielModule';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'something' | someFilter }}
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new TwigFilter('someFilter', [$this, 'someInternalFunction']),
        ];
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = someFunction('something') %}
     *
    * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('serviceFeeFunction', [$this, 'serviceFeeInternalFunction']),
            new TwigFunction('genresCollectionFunction', [$this, 'genresCollectionInternalFunction'])
        ];
    }

    /**
     * Our function called via Twig; it can do anything you want
     *
     * @param null $text
     *
     * @return string
     */

    // --- Function to return serviceFee for event price formatted in Euros ---
    public function serviceFeeInternalFunction($price = null)
    {
      $price = $price->getAmount() / 100; // Convert price to a float from cents to euros
      $servicePercentage = 0.10; // is 10%. TODO: Add a field for service percentage.
      $serviceFee = $price * $servicePercentage;
      $fmt = new NumberFormatter('nl_NL', NumberFormatter::CURRENCY);
      return $fmt->formatCurrency($serviceFee, "EUR");
    }

    // --- Function to return array of unique genres from the event artists ---
    public function genresCollectionInternalFunction($event = null)
    {
      $genres = [];

      $artists = $event
      ->eventArtists
        ->with(['artistGenre'])
        ->all();

      foreach ($artists as $artist) {
        foreach ($artist->artistGenre as $genre) {
          $genres[] = $genre;
        }
      }
      return array_unique($genres);
    }
  }

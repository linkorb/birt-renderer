# BIRT Renderer

Render BIRT .rptdesign files from your PHP application

## Example usage

```php
use BirtRenderer\Renderer;
use BirtRenderer\Report;
use BirtRenderer\Parameter;

// Instantiate a report, by filename
$report = new Report();
$report->loadFilename('/home/yourname/example.rptdesign');

// Instantiate the Renderer
$renderer = new Renderer();
// Set the BIRT_HOME environment variable (important)
$renderer->setBirtHome('/home/yourname/birt-runtime-4_4_1');

// Create a list of report-parameters (key/value)
$parameters = array();
$parameters[] = new Parameter('Color', 'Red');
$parameters[] = new Parameter('Size', 'XL');

// Render the report, with supplied parameters to $outputfilename
$outputfilename = '/home/yourname/out.pdf';
$renderer->render($report, $parameters, $outputfilename);
```

## License

MIT (see LICENSE.md)

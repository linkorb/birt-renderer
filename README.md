# BIRT Renderer

Render BIRT `.rptdesign` files from your PHP application.

You can use the BIRT Designer to create reports, and save them as `.rptdesign` files.
Then you can generate the reports from your PHP application and present them to your end user.

The reports can be generated in HTML, PDF, DOC, XLS, PPT and Postscript.

## How it works

This library is a clean wrapper around the `genReport.sh` shell-script which is part of the BIRT Runtime.
This means that you'll need to have the BIRT Runtime installed (see below).

## Prerequisites: BIRT Runtime

You'll need to have a recent version of the BIRT Runtime extracted somewhere on your computer/server.

You can download it here: [http://download.eclipse.org/birt/downloads/](http://download.eclipse.org/birt/downloads/)

Make sure you download the `BIRT Runtime`, and not the `All-in-One` or other options.

After downloading the file (birt-runtime-4_4_1-20140916.zip at the time of this writing), simply extract the zip file somewhere on your disk.

You'll need to remember the pathname, as you'll need to when instantiating a new Renderer in your code.

## Example usage from PHP

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

## Example usage from the console

This library includes an example console command to invoke the library. You can use it like this:

    export BIRT_HOME=/home/yourname/birt-runtime-4_4_1
    ./bin/birt-renderer report:render --parameter Color=Red --parameter Size=XL myreport.rptdesign output.pdf

Based on the file-extension of the output file it will automatically detect the format.

## License

MIT (see [LICENSE.md](LICENSE.md))

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!

# League-Plates-Directories

This is a directories modification to the League/Plates engine, allowing for multiple directories to be added for fallback lookup.

This extension allows for a single instance the be appended by secondary modules without having to use the explicit Plates folder logic.  This extension works with the existing folder fallback logic.

# Usage

    // Initialize
    $engine = new Webuddha/Plates/Engine();

    // Add Directory to Lookup List
    $engine->addDirectory( '/templates/' );

    // Add More Directories to Lookup List
    $engine->addDirectory( ['/alt/templates/', '/mod/templates/'] );

    // Add a Folder with a Fallback flag
    $engine->addFolder( 'widget', '/widget/templates/', true );

    // Add a Folder without a Fallback flag
    $engine->addFolder( 'email', '/email/templates/' );

    // Attempt to render a folder template without fallback
    echo $template->render( 'email::welcome', $vars );

    // Attempt to render a folder template with fallback
    echo $template->render( 'widget::welcome', $vars );

    // Render a default template with fallback
    echo $template->render( 'welcome', $vars );

# The Logic

 1. We create an instance.
 2. We push paths onto the "directories" stack in order of fallback (first in, last out).
 3. We define our explicit folders, one with and one without the optional fallback flag.
 4. We attempt to render the "email::welcome" folder template, which will execute as follows:
	 - Exists /email/templates/welcome.php or
	 - Error
 5. We attempt to render the "widget::welcome" folder template, which will lookup as follows:
	 - Exists /widget/templates/welcome.php or
	 - Exists /mod/templates/welcome.php or
	 - Exists /alt/templates/welcome.php or
	 - Exists /templates/welcome.php or
	 - Error
 6. We attempt to render the "welcome" template, which will lookup as follows:
	 - Exists /mod/templates/welcome.php or
	 - Exists /alt/templates/welcome.php or
	 - Exists /templates/welcome.php or
	 - Error


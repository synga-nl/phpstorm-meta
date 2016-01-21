# phpstorm-meta
This package can create a .phpstorm.meta.php file. It searches for classes which implement the Synga\PhpStormMeta\PhpStormMetaExtensionInterface interface and executes those files.
By default it includes all classes who implement this interface in the .phpstorm.meta.php. But you can exclude classes with the exclude command.
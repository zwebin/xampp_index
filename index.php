<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Server Directory</title>
  <link rel="stylesheet" href="css/tailwind.min.css">
  <link rel="stylesheet" href="webfonts/css/all.min.css">
  <style>
    .directory-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .empty-state {
      background-color: rgba(254, 226, 226, 0.3);
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">
  <header class="bg-indigo-600 text-white shadow-lg">
    <div class="container mx-auto px-4 py-6">
      <div class="flex justify-between items-center">
        <div>
          <h1 class="text-2xl md:text-3xl font-bold flex items-center">
            <i class="fas fa-server mr-3"></i>
            Server Directory
          </h1>
          <p class="text-indigo-100 mt-1">Browse available directories and files</p>
        </div>
        <a href="http://localhost/phpmyadmin/" target="_blank" class="bg-white text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg font-medium flex items-center transition-colors">
          <i class="fas fa-database mr-2"></i> MySQL Admin
        </a>
      </div>
    </div>
  </header>

  <main class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      <!-- Subdirectories Section -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-indigo-50 px-6 py-4 border-b border-gray-200">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-folder-open text-indigo-500 mr-3"></i>
            Served Subdirectories
          </h2>
        </div>
        <div class="p-6">
          <?php
          $dirCount = 0;
          $directories = array_filter(scandir("./"), function($file) {
            return is_dir($file) && !in_array($file, array(".", "..", "css", "images"));
          });
          
          if (!empty($directories)) {
            foreach ($directories as $dir) {
              $dirCount++;
              echo '
              <a href="' . $dir . '" target="_blank" class="directory-card block bg-gray-50 hover:bg-indigo-50 rounded-lg p-4 mb-3 transition-all duration-200 ease-in-out border border-gray-200">
                <div class="flex items-center">
                  <div class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-4">
                    <i class="fas fa-folder text-lg"></i>
                  </div>
                  <div>
                    <h3 class="font-medium text-gray-800">' . $dir . '</h3>
                    <p class="text-sm text-gray-500">Directory</p>
                  </div>
                  <div class="ml-auto text-indigo-500">
                    <i class="fas fa-external-link-alt"></i>
                  </div>
                </div>
              </a>';
            }
          } else {
            echo '
            <div class="empty-state rounded-lg p-6 text-center">
              <i class="fas fa-folder-open text-gray-400 text-4xl mb-3"></i>
              <h3 class="text-gray-600 font-medium">No subdirectories found</h3>
              <p class="text-gray-500 mt-1">There are no accessible subdirectories in this location.</p>
            </div>';
          }
          ?>
        </div>
        <div class="bg-gray-50 px-6 py-3 text-sm text-gray-500 border-t border-gray-200">
          <i class="fas fa-info-circle mr-2"></i> Showing <?php echo $dirCount; ?> subdirectories
        </div>
      </div>

      <!-- PHP Files Section -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-indigo-50 px-6 py-4 border-b border-gray-200">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-file-code text-indigo-500 mr-3"></i>
            Served PHP Files
          </h2>
        </div>
        <div class="p-6">
          <?php
          $fileCount = 0;
          $phpFiles = array_filter(scandir("./"), function($file) {
            return strtolower(strrchr($file, '.')) == ".php" && $file != "index.php";
          });
          
          if (!empty($phpFiles)) {
            foreach ($phpFiles as $file) {
              $fileCount++;
              echo '
              <a href="' . $file . '" target="_blank" class="directory-card block bg-gray-50 hover:bg-indigo-50 rounded-lg p-4 mb-3 transition-all duration-200 ease-in-out border border-gray-200">
                <div class="flex items-center">
                  <div class="bg-purple-100 text-purple-600 p-2 rounded-lg mr-4">
                    <i class="fab fa-php text-lg"></i>
                  </div>
                  <div>
                    <h3 class="font-medium text-gray-800">' . $file . '</h3>
                    <p class="text-sm text-gray-500">PHP Script</p>
                  </div>
                  <div class="ml-auto text-indigo-500">
                    <i class="fas fa-external-link-alt"></i>
                  </div>
                </div>
              </a>';
            }
          } else {
            echo '
            <div class="empty-state rounded-lg p-6 text-center">
              <i class="fas fa-file-alt text-gray-400 text-4xl mb-3"></i>
              <h3 class="text-gray-600 font-medium">No PHP files found</h3>
              <p class="text-gray-500 mt-1">There are no accessible PHP files in this location.</p>
            </div>';
          }
          ?>
        </div>
        <div class="bg-gray-50 px-6 py-3 text-sm text-gray-500 border-t border-gray-200">
          <i class="fas fa-info-circle mr-2"></i> Showing <?php echo $fileCount; ?> PHP files
        </div>
      </div>
    </div>
  </main>

  <footer class="bg-gray-100 border-t border-gray-200 mt-12">
    <div class="container mx-auto px-4 py-6">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
          <p class="text-gray-600">
            <i class="fas fa-code text-indigo-500 mr-1"></i> 
            Server Directory Browser
          </p>
        </div>
        <div class="flex space-x-4">
          <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
            <i class="fab fa-github"></i>
          </a>
          <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-gray-500 hover:text-indigo-600 transition-colors">
            <i class="fas fa-envelope"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
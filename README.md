# simple-blog

simple single file blog in php and NO javascript  

### Requirements: 

https://github.com/asancheza/parsedown-php - i have not checked if the latest version has any changes that effect this blog  
Must create the following folders in the same dir as index.php: posts, pages, images  

### usage

to post files simply put the markdown file in posts/ in numerical order like so: 0.md,1.md,2.md... the largest number is always the latest post.  

For pages you can name them anything and place them in pages/file.md  
To call the page simply use markdown in your post or sidebar.md:  

    [pagename](pages/?p=pages/pagename)

This is for personal Use without support!  

__ToDO:__  

1. Fix how pagnation and pages are created
2. Automaticaly add the folders and a sample post if they dont exist  
Redesign UI  

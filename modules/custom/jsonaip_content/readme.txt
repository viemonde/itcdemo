I want to implement module jsonapi_content (depend on module jsonapi of drupal core).This module will provide:
1. The routing like jsonapi/path?path=%
 where the param path will be a url (or alias url) this will be handle by a callback function:
 
   - first this callback function will resolve this to actuall url then call the handle of this url to execute 
   (note: need to handdle the same as the handle or this url, inlcude check permisson, and return the content rendered)
   - the reutnr of this will be adapt as jsonapi module define
   
2. The rout lik jsonapi/block?block=%
  where the param blolck is blok id for a block in drupal. this will be handle by a callback function:
  - fist check  this block is valid, if valid, load the block content (I mean render the block content) then return as 
  jsonapi structure

2. The rout lik jsonapi/block?region=%&url=%
  where the param region is name of the region and url is the url. This will be used to check the setting of block in side regaion
  -  this will be callback a function to load all block inside a region with and check the setting is suite for this url or note
   then render all block content and return as jsonapi structure

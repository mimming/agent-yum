<?php /*
Copyright (C) 2013  Agent Yum - http://agentyum.com

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

 Authors:
 - Jenny Murphy - http://mimming.com
 - Jennifer Wang - http://jewang.net
 - Matt Abdou - http://mattabdou.com
 - Winona Tong - http://winonatong.com
*/ ?>
<span data-role="button" data-theme="e" id="fakefile">Scan Image</span>
	
<form id="form" action="upload.php" data-role="none" method="post"
			enctype="multipart/form-data" data-ajax="false">

            <label>
<input id="file" type="file" name="image" 
				accept="image/*" capture="camera">
            </label>
			
		</form>

//检出
svn checkout svn://60.205.228.27 --username wangwen
svn co svn://60.205.228.27 --username wangwen

//添加新文件
svn add test.php

//提交
svn commit -m '提交日志'
svn ci -m '提交日志'

//更新文件
svn update 
svn up

//删除文件
svn delete test.php
svn ci -m '删除某个文件的日志'

//比较差异
svn diff test.php

//查看文件或目录状态
svn status 目录路径/名＜－目录下的文件和子目录的状态，正常状态不显示 
　　　　　　　　　　　　　【?：不在svn的控制中； M：内容被修改；C：发生冲突；
　　　　　　　　　　　　　　A：预定加入到版本库；K：被锁定】

//查看日志
svn log test.php

//回退没有提交的修改
svn revert [-R] 目录

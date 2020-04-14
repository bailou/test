# canvas绘图

### 1.1 **浏览器不兼容问题**

- ie9以上才支持canvas, 其他chrome、firefox、苹果浏览器等都支持
-  只要浏览器兼容canvas，那么就会支持绝大部分api(个别最新api除外)
-  移动端的兼容情况非常理想，基本上随便使用
-  2d的支持的都非常好，3d（webgl）ie11才支持，其他都支持
-  如果浏览器不兼容，最好进行友好提示，提示内容只有在浏览器不支持时才显示。

```
 //例如：
<canvas id="cavsElem">
        你的浏览器不支持canvas，请升级浏览器
    </canvas>
```

### 1.2 **创建画布**

在页面中创建canvas元素与创建其他元素一样，只需要添加一个<canvas>标记即可。该元素默认的宽高为300*15，可以通过元素的width属性和height属性改变默认的宽高。

注意：

-  不能使用CSS样式控制canvas元素的宽高，否则会导致绘制的图形拉伸。

 

- 重新设置canvas标签的宽高属性会导致画布擦除所有的内容。

 

- 可以给canvas画布设置背景色

### 1.3 **canvas坐标系**

在开始绘制任何图像之前，我们先讲一下canvas的坐标系。canvas坐标系是以左上角0,0处为坐标原点，水平方向为x轴，向右为正；垂直方向为y轴，向下为正。如下图所示：

![img](https://images2017.cnblogs.com/blog/1188378/201709/1188378-20170912141129844-494006191.png)

### 1.4 **绘制线径**

​		1.**获取上下文对象（CanvasRenderingContext2D）**

​					首先，获取canvas元素，然后调用元素的getContext(“2d”)方法，该方法返回一个CanvasRenderingContext2D对象，使用该对象就可以在画布上绘图了。

```
var mcanvas  = document.getElementById("mcanvas");    //获得画布

var mcontext = mcanvas.getContext("2d");  //获得上下文
```

​		**2.设置绘制起点**

```
//语法：
ctx.moveTo(x, y); 
```

\* 解释：设置上下文绘制路径的起点。相当于移动画笔到某个位置。

\* 参数：x,y 都是相对于 canvas坐标系的原点（左上角）。

\* 注意： 绘制线段前必须先设置起点，不然绘制无效。如果不进行设置，就会使用lineTo的坐标当作moveTo

​		3.**绘制直线(lineTo)**

```
//语法：
ctx.lineTo(x, y);
```

\* 解释：从上一步设置的绘制起点绘制一条直线到(x, y)点。

\* 参数：x,y 目标点坐标。

​		**4.路径的开始和闭合**

```
//开始路径：
ctx.beginPath();
//闭合路径：
ctx.closePath();
```

​		5.**绘制图形(stroke)**

```
//语法：
ctx.stroke();
```

\* 解释：根据路径绘制线。路径只是草稿，真正绘制线必须执行stroke

 

在绘制之前，还可以对画笔的颜色和粗细进行设置进行设置，方法如下：

```
//语法：
ctx.strokeStyle = “#ff0000”;
ctx.lineWidth = 4;  //值为不带单位的数字，并且大于0
```

​		6.**填充图形(fill)**

```
//语法：
ctx.fill();
```

\* 解释：对已经画好的图形进行填充颜色。

 

在填充之前，同样可以对所填充的颜色进行设置，方法如下：

```
//语法：
ctx.fileStyle = “#0000ff”;
```

7.**canvas绘制的基本步骤：**

 

第一步：获得上下文 =>canvasElem.getContext('2d');

 

第二步：开始路径规划 =>ctx.beginPath()

 

第三步：移动起始点 =>ctx.moveTo(x, y)

 

第四步：绘制线(线条、矩形、圆形、图片...) =>ctx.lineTo(x, y)

 

第五步：闭合路径 =>ctx.closePath();

 

第六步：绘制描边 =>ctx.stroke();

 

案例：通过上面所学的方法绘制一个三角形。

[![复制代码](https://common.cnblogs.com/images/copycode.gif)](javascript:void(0);)

![复制代码](https://common.cnblogs.com/images/copycode.gif)

```
    <canvas id="mcanvas">你的浏览器不支持canvas，请升级浏览器</canvas>
    <script>
        
        var mcanvas  = document.getElementById("mcanvas");    //获得画布

        var mcontext = mcanvas.getContext("2d");    //获得上下文

        mcanvas.width = 900;     //重新设置标签的属性宽高
        mcanvas.height = 600;    //千万不要用 canvas.style.height

        mcanvas.style.border = "1px solid #000";    //设置canvas的边

        //绘制三角形
        mcontext.beginPath();        //开始路径
        mcontext.moveTo(100,100);    //三角形，左顶点
        mcontext.lineTo(300, 100);   //右顶点
        mcontext.lineTo(300, 300);   //底部的点
        mcontext.closePath();        //结束路径
        mcontext.stroke();           //描边路径

    </script>
```

8.**绘制矩形**

​		**1.快速创建矩形rect()方法**

```
语法：ctx.rect(x,y,width,height);
```

​		\* 解释：x, y是矩形左上角坐标， width和height都是以像素计

​        \*rect方法只是规划了矩形的路径，并没有填充和描边。

2.**创建描边矩形**

```
语法：ctx.strokeRect(x, y, width, height);
```

 

参数跟rect(x, y, width, height)相同，注意此方法绘制完路径后立即进行stroke绘制。

3.**创建填充矩形**

```
语法：ctx.fillRect(x, y, width, height);
```

参数跟rect(x, y, width, height)相同， 此方法执行完成后，立即对当前矩形进行fill填充。

4.**清除矩形（clearReact）**

```
语法：ctx.clearRect(x, y, width, hegiht);
```

\* 解释：清除某个矩形内的绘制的内容，相当于橡皮擦。

**9.绘制圆形**

arc()方法用于创建弧线（用于创建圆或部分圆）。

```
语法：ctx.arc(x, y, r, startAngle, endAngle, counterclockwise);
```



```
解释：
x,y：圆心坐标。
r：半径大小。
sAngle:绘制开始的角度。 圆心到最右边点是0度，顺时针方向弧度增大。
eAngel:结束的角度，注意是弧度。
counterclockwise：是否是逆时针，默认是false。true是逆时针，false：顺时针

注意：弧度和角度的转换公式： rad = deg*Math.PI/180;
复制代码
```

**10.绘制文字**

canvas提供了两种方法来渲染文本：

```
fillText(text,x,y[,maxWidth])
```

在指定的（x,y）位置填充指定的文本，绘制的最大高度是可选的。

```
strokeText(text,x,y[,maxWidth])
```

在指定的（x,y）位置绘制文本边框，绘制的最大宽度是可选的。

示例1

 

文本用当前的填充方式被填充：

```
var ctx = document.getElementById('canvas').getContext('2d');

 ctx.font = "48px serif";
 ctx.fillText("Hello world", 10, 50);
```

示例2

文本用当前的边框样式被绘制：

```
 var ctx = document.getElementById('canvas').getContext('2d');
  ctx.font = "48px serif";
  ctx.strokeText("Hello world", 10, 50);
```

### **11.绘制图像**

1.基本绘制图片的方式

```
context.drawImaage(img,x,y);
```

参数说明：x,y绘制图片左上角的坐标，img是绘制图片的Dom对象

2.**在画布上绘制图像，并规定图像的宽度和高度**

```
context.drawImage(img,x,y,width,height);  
```

参数说明：width 绘制图片的宽度，  height：绘制图片的高度

如果指定宽高，最好成比例，不然图片会被拉伸

```
设置高 = 原高度 * 设置宽/ 原宽度;
```

3.**图片裁剪，并在画布上定位被裁剪的部分**

```
context.drawImage(img,sx,sy,swidth,sheight,x,y,width,height);
```

参数说明：

  sx,sy 裁剪的左上角坐标，

  swidth：裁剪图片的高度。 sheight:裁剪的高度

其他同上

4.**用javascript创建img对象**

 

上面提供的3个方法，都需要一个Image对象作为参数，下面介绍了几种创建Image对象的方式。需要注意的是，为Image的src属性赋值后，Image对象会去装载指定图片，但这种装载是异步的，如果图片太大或则图片来自网络，且网络传输速度慢，Image对象装载图片就会需要：一定的时间开销。为了保证图片装载完成后才去绘制图片，可以监听Image对象的onload回调事件，然后在事件处理函数中绘制图片，如下所示：

 

第一种方式：

```
  var img = document.getElementById("imgId");
　　　　img.onload = function(){  //图片加载完成后，执行此方法
  　　  mcontext.drawImage(img, 10, 10);
    }
```

第二种方式：

[![复制代码](https://common.cnblogs.com/images/copycode.gif)](javascript:void(0);)

```
var img = document.createElement("img");
        img.src = "img/a.jpg";
        img.alt = "谁笑谁是小狗";
        img.onload = function(){  //图片加载完成后，执行此方法
            mcontext.drawImage(img, 10, 10);
        }
```

[![复制代码](https://common.cnblogs.com/images/copycode.gif)](javascript:void(0);)

第三种方式：

[![复制代码](https://common.cnblogs.com/images/copycode.gif)](javascript:void(0);)

```
var img = new Image();//这个就是 img标签的dom对象
    img.src = "imgs/arc.gif";
    img.alt = "谁笑谁是小狗";
    img.onload = function() {  //图片加载完成后，执行此方法
        
    }
```
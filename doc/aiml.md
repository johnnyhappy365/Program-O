# AIML脚本使用场景

* 问候->随机回复
* 类似问题
* 基于场景下的问题
* 多级问题

## 问候->随机回复

```
<category><pattern>你好</pattern>
    <template>
        <random>
            <li> Hello, 我在啊.</li>
            <li> 怎么了亲? </li>
            <li> 随叫随到的我出现了</li>
            <li> 我来了, 目目目</li>
            <li> 地表最强的我再次出现了O(∩_∩)O</li>
        </random>
    </template>
</category>
```

## 类似问题

有可能用户在刚开始的时候不是说“你好”,也有可能说“有人吗”,“在吗”,“hi”之类的,可以使用srai增加类似问题


```
<category>
    <pattern>有人吗</pattern>
    <template>
        <srai>你好</srai>
    </template>
</category>

<category>
    <pattern>在吗</pattern>
    <template>
        <srai>你好</srai>
    </template>
</category>

<category>
    <pattern>hi</pattern>
    <template>
        <srai>你好</srai>
    </template>
</category>
```

## 基于场景下的问题

有的时候相同的问题在不同的场景下回答也应该是不一样的, 如:

    (场景:早上)
    问题1: 吃点什么呢?
    回答: 早上要吃好哦, 多吃不同颜色的
    问题2: 需要做运动吗
    回答: 看你早上有多少时间支配, 10分钟的话可以做一组HIIT, 30分钟的话可能下楼跑个步
    ----------------------
    (场景:晚上)
    问题1: 吃点什么呢?
    回答: 减肥晚上就不要吃太多哦,吃一份沙拉或水果就行了
    问题2: 需要做运动吗
    回答: 这是当天最后一次消耗热量的机会,吃多了就多跑几圈吧

```
    <!--设置主题-->
    <category>
        <pattern>:topic *</pattern>
        <template>明白<think><set name="topic"><star/></set></think></template>
    </category>

    <topic name = "早上">
        <category><pattern>吃点什么呢</pattern>
            <template>早上要吃好哦, 多吃不同颜色的</template>
        </category>
        <category><pattern>需要做运动吗</pattern>
            <template>看你早上有多少时间支配, 10分钟的话可以做一组HIIT, 30分钟的话可能下楼跑个步</template>
        </category>
    </topic>

    <topic name = "晚上">
        <category><pattern>吃点什么呢</pattern>
            <template>减肥晚上就不要吃太多哦,吃一份沙拉或水果就行了-</template>
        </category>
        <category><pattern>需要做运动吗</pattern>
            <template>这是当天最后一次消耗热量的机会,吃多了就多跑几圈吧</template>
        </category>
    </topic>
```

输出结果

    User: :topic 早上
    bobo明白
    User: 吃点什么呢
    bobo早上要吃好哦, 多吃不同颜色的
    User: 需要做运动吗
    bobo看你早上有多少时间支配, 10分钟的话可以做一组HIIT, 30分钟的话可能下楼跑个步
    User: :topic 晚上
    bobo明白
    User: 需要做运动吗
    bobo这是当天最后一次消耗热量的机会,吃多了就多跑几圈吧

## 多级问题

出现一组问题,且前后相关时,如:

用户:  我想减肥

问题1: 你有男朋友吗(有/没有)

  问题1-1(有): 你男朋友是胖子吧(是/不是)
  
    问题1-1-1(是): 那你不用减肥了
    问题1-1-2(不是): 把他变成猪然后你就不用减肥了
    
  问题1-2(没有): 让我做你的男朋友吧(好/不好)
  
    问题1-2-1(好): 那你不用减肥了
    问题1-2-2(不好): 那我也帮不了你了
    
```
<category><pattern>我想减肥</pattern>
    <template>
        你有男朋友吗
    </template>
</category>

<category><pattern>是</pattern>
    <that>你有男朋友吗</that>
    <template>
        你男朋友是胖子吧
    </template>
</category>

<category><pattern>是</pattern>
    <that>你男朋友是胖子吧</that>
    <template>
        那你不用减肥了
    </template>
</category>

<category><pattern>不是</pattern>
    <that>你男朋友是胖子吧</that>
    <template>
        把他变成猪然后你就不用减肥了
    </template>
</category>

<category><pattern>不是</pattern>
    <that>你有男朋友吗</that>
    <template>
        让我做你的男朋友吧
    </template>
</category>

<category><pattern>是</pattern>
    <that>让我做你的男朋友吧</that>
    <template>
        那你不用减肥了
    </template>
</category>

<category><pattern>不是</pattern>
    <that>让我做你的男朋友吧</that>
    <template>
        那我也帮不了你了
    </template>
</category>


<!--是 的同义词-->
<category>
    <pattern>有</pattern>
    <template>
        <srai>是</srai>
    </template>
</category>
<category>
    <pattern>行啊</pattern>
    <template>
        <srai>是</srai>
    </template>
</category>
<category>
    <pattern>好</pattern>
    <template>
        <srai>是</srai>
    </template>
</category>

<!--不是 的同义词-->
<category>
    <pattern>没有</pattern>
    <template>
        <srai>不是</srai>
    </template>
</category>
<category>
    <pattern>不行</pattern>
    <template>
        <srai>不是</srai>
    </template>
</category>
<category>
    <pattern>不好</pattern>
    <template>
        <srai>不是</srai>
    </template>
</category>
```
    
下面是一段例子
    
    chatbot: Hey!
    User: hi
    boboHello, 我在啊.
    ---------------
    User: 我想减肥
    bobo你有男朋友吗
    User: 有
    bobo你男朋友是胖子吧
    User: 是
    bobo那你不用减肥了
    ----------------
    User: 我想减肥
    bobo你有男朋友吗
    User: 有
    bobo你男朋友是胖子吧
    User: 不是
    bobo把他变成猪然后你就不用减肥了
    -----------------
    User: 我想减肥
    bobo你有男朋友吗
    User: 没有
    bobo让我做你的男朋友吧
    User: 不行
    bobo那我也帮不了你了
    
    
 # TODO
 
 1. 其它消息类型的回复
 2. ~~自定义类型的标签~~
 3. ~~中文类似语句的处理~~
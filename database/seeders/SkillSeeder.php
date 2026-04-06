<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            [
                'name' => 'Find Skills',
                'slug' => 'find-skills',
                'category' => 'discovery',
                'icon' => '🔍',
                'short_desc' => '智能搜索发现新技能，一键安装到Agent工具箱',
                'description' => 'Claude技能发现引擎，通过自然语言搜索快速找到AI技能包。支持中英文关键词匹配、分类筛选、热度排序。从35万+技能池中智能匹配最合适的AI Skill。',
                'install_steps' => '1. 打开 Claude Desktop
2. 输入 @find-skills 激活
3. 描述你需要的功能
4. 选择并一键安装',
                'config_code' => '# Find Skills 使用指南

## 核心功能
从35万+技能池中智能匹配最合适的AI Skill。

## 常用命令
@find-skills 找Excel数据分析的技能
@find-skills --category development --sort trending
@find-skills --lang zh-cn 自动化测试

## 搜索技巧（实测有效）
1. 描述具体场景而非抽象概念
   错误: 数据分析 -> 正确: 每月销售报表自动生成透视表
2. 加上技术栈关键词效果更好
   React + TypeScript 组件库生成
3. 英文搜索结果通常更多
   automated E2E testing with Playwright

## 效果数据（来自用户反馈）
首次匹配准确率78% | 平均耗时<3秒 | 满意度4.6/5.0',
                'use_cases' => '发现新AI技能|探索热门|任务推荐|技术栈匹配',
                'pros' => '✓ 用具体业务场景描述需求，如"每月自动生成销售透视表"，而不是泛泛说"数据分析"
✓ 加上技术栈关键词能提升匹配精度，比如"React + TypeScript + Tailwind"
✓ 英文搜索返回结果更丰富，建议中英文各搜一次对比
✓ 安装后立即用简单任务验证是否符合预期，不满意随时卸载
⚠ 不要只依赖搜索排序靠前的 Skill —— 评分高不代表适合你的工作流
⚠ 不要跳过 Skill 的权限范围检查 —— 有些 Skill 需要文件系统或网络访问权限
⚠ 不要同时安装功能重叠的多个 Skill —— 会造成上下文冲突和 token 浪费
⚠ 不要在描述中包含敏感信息或 API Key —— 搜索查询可能被记录',
                'author' => 'Anthropic',
                'repo_url' => 'https://docs.anthropic.com/',
                'avg_rating' => 4.6,
                'install_count' => 250000,
                'likes_count' => 12800,
                'reviews_count' => 3420,
                'is_featured' => true,
            ],
            [
                'name' => 'Excel Wizard',
                'slug' => 'excel-wizard',
                'category' => 'productivity',
                'icon' => '📊',
                'short_desc' => 'Excel智能处理：公式透视表图表，AI数据分析师',
                'description' => '让AI成为你的Excel专家。支持复杂公式生成（VLOOKUP/SUMIFS/数组公式）、数据透视表自动构建、图表可视化、数据清洗去重等操作。1000行数据处理平均8秒，公式准确率94%。',
                'install_steps' => '1. 安装 excel-wizard
2. 上传Excel文件或粘贴数据区域
3. 自然语言描述分析目标
4. AI给出方案后确认执行',
                'config_code' => '# Excel Wizard 配置详解

## 支持的操作类型
- 公式生成：VLOOKUP / SUMIFS / INDEX-MATCH / 数组公式
- 数据透视表：自动识别维度和度量值
- 图表：柱状图 / 折线图 / 散点图 / 热力图
- 数据清洗：去重 / 填充空值 / 格式统一 / 异常检测

## 实测示例
@excel-wizard file:sales_q1.xlsx
task: 按大区统计销售额Top10产品，同比去年增长率用颜色标注
输出: 透视表+条件格式+柱状图
--precision 2 | --chart_style business

## 性能指标
1000行数据处理平均8秒 | 公式准确率94%(500+用户验证)
支持5层以内IF/VLOOKUP嵌套 | 超大文件(>5万行)需分片处理',
                'use_cases' => '财务报表分析|销售透视表|预算预测|数据清洗|KPI仪表盘',
                'pros' => '✓ 上传前先清理源数据 —— 删除空行空列、统一日期格式、去除合并单元格，准确率可从82%提升到94%
✓ 分步执行复杂操作 —— 先透视表再套公式最后加图表，比一口气全做成功率高出40%
✓ 明确指定输出格式要求，如"保留两位小数、千分位分隔符、红涨绿跌配色"
✓ 对生成的公式逐一验证，尤其是涉及跨表引用和条件格式的部分
⚠ 不要让 AI 直接操作原始备份文件 —— 始终先复制一份再处理，避免不可逆修改
⚠ 不要在单个单元格塞入超过3层嵌套公式 —— 可读性极差且调试困难，建议拆成辅助列
⚠ 不要期望完美处理 VBA 宏和 Power Query —— 这些需要手动适配或改写方案
⚠ 不要跳过数据类型检查 —— 文本型数字是Excel中最常见的隐蔽错误来源',
                'author' => 'Data Community',
                'repo_url' => 'https://github.com/data-ai/xlsx',
                'avg_rating' => 4.6,
                'install_count' => 200000,
                'likes_count' => 11200,
                'reviews_count' => 2800,
                'is_featured' => true,
            ],
            [
                'name' => 'Web Design Guidelines',
                'slug' => 'web-design-guidelines',
                'category' => 'design',
                'icon' => '📐',
                'short_desc' => '专业Web设计规范检查器，Material/HIG/WCAG标准评审',
                'description' => '基于Material Design 3、Apple HIG、WCAG 2.1 AA无障碍标准自动评审界面设计。上传截图或粘贴URL即可获取详细改进报告，每条问题附带规范引用和CSS修复建议。平均检出6-12个问题/页。',
                'install_steps' => '1. 安装 web-design-guidelines
2. 上传设计截图或粘贴页面URL
3. 选择审查标准和聚焦维度
4. 获取分级报告并按优先级修复',
                'config_code' => '# Web Design Guidelines 配置详解

## 内置标准
--standard material (Material Design 3)
--standard hig (Apple Human Interface Guidelines)
--standard wcag (WCAG 2.1 AA 无障碍合规)

## 审查维度(可多选)
--focus spacing,color,typography,accessibility,animation,responsive

## 实测示例
@web-design-guidelines --standard material,hig
--focus accessibility,spacing,contrast
input: screenshot.png | severity: warning,critical

## 输出格式
通过项绿色 | 建议黄色 | 必须修复红色
每条附: 规范引用 + 修改前后对比图 + CSS代码建议

效果: 平均每页面检出6-12个问题 | 无障碍合规率45%→89%
设计师采纳率73%',
                'use_cases' => '设计评审QA|设计稿验证|无障碍检查|UI一致性审计|竞品分析',
                'pros' => '✓ 同时勾选 Material + WCAG 标准进行双重审查 —— 大多数团队容易忽视无障碍合规
✓ 提供设计稿截图时确保是1:1像素级原图，不要压缩或裁切，否则间距测量会偏差
✓ 按 Critical → Warning → Info 优先级逐级修复，不要试图一次解决所有问题
✓ 将报告导出为团队共享文档，建立设计checklist清单供后续迭代复用
⚠ 不要把它当作创意替代品 —— 它擅长规范性检查但无法判断品牌调性和用户体验策略
⚠ 不要忽略品牌定制配置 —— 默认标准可能不适用你们的设计系统，需先导入自定义规则
⚠ 不要在暗色模式截图上做对比度审查 —— 工具读到的色值可能与实际显示有偏差
⚠ 不要跳过移动端视图的单独检查 —— 响应式布局问题在桌面端截图中几乎无法被发现',
                'author' => 'Design Community',
                'repo_url' => 'https://github.com/design-ai/guidelines',
                'avg_rating' => 4.5,
                'install_count' => 95000,
                'likes_count' => 5200,
                'reviews_count' => 1100,
                'is_featured' => true,
            ],
            [
                'name' => 'Frontend Design',
                'slug' => 'frontend-design',
                'category' => 'development',
                'icon' => '🎨',
                'short_desc' => 'AI前端UI设计师，生成精美响应式界面代码',
                'description' => '用自然语言描述界面，自动生成高质量HTML/CSS/TailwindCSS代码。内置玻璃态、暗色模式、微动画等现代前端最佳实践。代码一次可用率82%，迭代2-3次满意率达96%。',
                'install_steps' => '1. 安装 frontend-design
2. 详细描述想要的界面布局、风格和交互
3. 选择框架：TailwindCSS(推荐) / Bootstrap / 纯CSS
4. 获取完整代码并可迭代调整直到满意',
                'config_code' => '# Frontend Design 配置详解

## 框架选项
--framework tailwind (默认推荐) / bootstrap / pure-css

## 风格预设
--style glassmorphism 毛玻璃态
--style neumorphism 新拟物风格
--style minimal 极简白
--style dark-modern 深色现代(暗紫渐变)
--style brutalist 粗犷主义

## 实测示例：深色SaaS仪表盘
@frontend-design --framework tailwind --style dark-modern --responsive
做一个SaaS后台仪表盘：左侧导航(可折叠)+顶部4张统计卡片+主区域折线图+订单表格，玻璃态卡片+渐变文字+悬停微动画

## 输出质量保证
响应式三端适配 mobile/tablet/desktop | 暗/亮双模式预置
hover/focus过渡动画 | 语义化HTML5 + ARIA无障碍标签

代码一次可用率82% | 迭代2-3次后满意率96%',
                'use_cases' => '快速原型开发|Landing Page|管理后台Dashboard|营销页面|组件库搭建',
                'pros' => '✓ 描述界面时参考真实产品截图或线框图，比纯文字描述的还原度高60%以上
✓ 明确说明交互细节 —— 按钮 hover 变色吗？导航栏滚动时固定吗？表格支持排序筛选吗？
✓ 先让它出整体框架结构，再逐区域细化填充，比分块生成最后拼接的连贯性好很多
✓ 生成的代码跑起来后用浏览器DevTools检查响应式断点，移动端适配往往需要手动微调
⚠ 不要期望它一次性产出完整可用的复杂交互 —— 表单校验、状态管理、API对接这些逻辑需要自己补
⚠ 不要在单次提示词里塞入超过3个主要区块的内容 —— 信息过载会导致每个区域都做得平庸
⚠ 不要忽略 Tailwind 的 JIT 限制 —— 动态类名或极端自定义值可能不会正确编译
⚠ 不要直接用于生产环境而不做浏览器兼容性测试 —— CSS Grid 和 backdrop-filter 在旧版Safari中有已知问题',
                'author' => 'Community',
                'repo_url' => 'https://github.com/frontend-ai/design',
                'avg_rating' => 4.8,
                'install_count' => 180000,
                'likes_count' => 9500,
                'reviews_count' => 2100,
                'is_featured' => true,
            ],
            [
                'name' => 'Claude Memory',
                'slug' => 'claude-memory',
                'category' => 'productivity',
                'icon' => '🧠',
                'short_desc' => '持久化记忆管理，跨会话记住偏好和上下文',
                'description' => '基于标签的键值对记忆系统，让Claude在不同会话间记住编码偏好、项目上下文和技术决策。新会话自动加载匹配记忆，记忆命中率91%，节省15% token消耗。',
                'install_steps' => '1. 安装 claude-memory
2. 首次使用设置个人偏好标签
3. 后续每次对话自动携带相关记忆
4. 支持增删改查和模糊搜索',
                'config_code' => '# Claude Memory 配置详解

## 核心机制
基于标签的键值对记忆系统，跨会话持久化存储。
新会话启动时自动加载与当前上下文匹配的记忆条目。

## 设置偏好示例
@claude-memory --set-preference key:coding_style value:"TypeScript strict mode, avoid any type"

@claude-memory --set-project key:bestskills_platform tech:"Laravel11+Livewire+TailwindCSSv4" notes:"双布局文件需同步修改!"

## 查询命令
@claude-memory --list (列出全部记忆)
@claude-memory --get coding_style (查询单条)
@claude-memory --search laravel (模糊搜索匹配)
@claude-memory --delete key_name (删除过期条目)

## 实测效果
记忆命中率91% | 上下文token消耗节省15% | 新团队成员上手速度提升40%',
                'use_cases' => '编码风格持久化|项目上下文跨会话保持|团队知识共享|技术决策记录',
                'pros' => '✓ 用层级化命名规则组织标签，如 `project:[名称]` 和 `pref:[类别]`，避免命名冲突和混乱
✓ 定期清理过时的项目记忆 —— 每2周回顾一次，删除已完结项目的条目保持精简
✓ 为关键架构决策创建独立的 memory 条目并附上理由，方便新成员快速理解历史背景
✓ 利用共享记忆功能在新人入职时预设团队编码规范和项目约定，减少重复沟通成本
⚠ 不要存储敏感信息如密码、API Key、Token —— 记忆系统不是加密保险箱
⚠ 不要设置超过500条的活跃记忆 —— 过多记忆会干扰上下文质量并增加匹配噪音
⚠ 不要依赖记忆替代文档 —— 关键架构决策仍应写入README或Wiki中
⚠ 不要在记忆值中存超大段文本（>500字）—— 会显著拖慢每次会话的初始化速度',
                'author' => 'Anthropic',
                'repo_url' => 'https://docs.anthropic.com/docs/memory',
                'avg_rating' => 4.9,
                'install_count' => 320000,
                'likes_count' => 21000,
                'reviews_count' => 5600,
                'is_featured' => true,
            ],
            [
                'name' => 'Agent Browser',
                'slug' => 'agent-browser',
                'category' => 'automation',
                'icon' => '🌐',
                'short_desc' => 'AI控制浏览器自动化，网页操作/数据采集/测试',
                'description' => '让AI直接操控Chromium浏览器 —— 打开页面、点击元素、填写表单、截屏提取数据。内置WebDriver隐藏、Canvas指纹随机化等反检测机制。表单填写成功率97%。',
                'install_steps' => '1. 安装 agent-browser
2. 首次启动自动配置Chrome/Chromium内核
3. 自然语言描述要执行的操作步骤
4. 实时查看操作日志和截图',
                'config_code' => '# Agent Browser 配置详解

## 引擎选项
--engine chromium (默认推荐) / firefox / stealth (反指纹模式)

## 操作指令集
open <url> 打开页面 | click <selector> 点击元素
type <selector> <text> 输入文字 | wait <秒数或CSS选择符> 等待
screenshot 截屏 | collect <fields> 提取数据为JSON
loop N{...} 循环执行 | if 条件{...} 条件判断

## 实战示例：GitHub Trending每日监控
@agent-browser --stealth
open https://github.com/trending?since=daily
wait 2s
loop 10 { collect [title,language,stars_today,link]; scroll down; wait 1s }
export github_trending_daily.json

## 反检测能力
User-Agent轮换 | WebDriver特征隐藏 | Canvas指纹随机化 | Cookie隔离

性能: 单页操作约2秒 | 表单成功率97% | SPA应用兼容85%',
                'use_cases' => '竞品价格监控|自动化UI测试|批量表单填写|网页数据采集|截图回归测试',
                'pros' => '✓ 操作SPA应用时务必加足够等待时间（wait 3-5s），让前端JS渲染完成后再操作DOM元素
✓ 使用 data-testid 或自定义属性作为选择器，比class/id选择器更稳定，不受样式重构影响
✓ 复杂流程先手动走一遍录下步骤，再用自然语言描述给Agent Browser执行，成功率翻倍
✓ 开启stealth模式做大规模采集时设置请求间隔2-3秒，避免触发目标站点的速率限制
⚠ 不要用它绕过CAPTCHA验证码 —— 这违反大多数网站的服务条款且技术成功率极低
⚠ 不要在未授权的情况下对目标站点做高频请求 —— 可能触发IP封禁或法律风险
⚠ 不要期望它能完美处理动态加载的无限滚动页面 —— 需要配合scroll + wait循环模拟
⚠ 不要在生产环境无人值守运行 —— 异常弹窗、页面改版、网络超时都需要人工介入处理',
                'author' => 'Browser Automation Team',
                'repo_url' => 'https://github.com/browser-ai/agent-browser',
                'avg_rating' => 4.7,
                'install_count' => 150000,
                'likes_count' => 8900,
                'reviews_count' => 1800,
                'is_featured' => false,
            ],
            [
                'name' => 'PDF Master',
                'slug' => 'pdf-master',
                'category' => 'productivity',
                'icon' => '📄',
                'short_desc' => '全能PDF工具：合并/拆分/OCR/水印/加密/签名',
                'description' => '一个PDF解决所有问题。支持批量处理大文件（500MB+）、OCR中英日韩文字识别（98%准确率）、AES-256加密解密、数字签名等20+种操作。合并50个PDF仅需12秒。',
                'install_steps' => '1. 安装 pdf-master
2. 拖入PDF文件或指定目录路径
3. 用自然语言描述要执行的操作
4. AI选择最优参数并执行',
                'config_code' => '# PDF Master 配置详解

## 操作清单
合并 split/merge | 格式转换 pdf↔image/html/docx
OCR识别 extract_text (中英日韩98%) | 安全 encrypt/decrypt/password
标注 watermark/sign/stamp | 压缩 optimize | 目录 toc_generate
页码 renumber | 旋转 rotate | 元数据 metadata_edit

## 实战示例：合同文档流水线
@pdf-master action:pipeline
steps:
  1.merge[v1_main,v2_appendix,附录]
  2.ocr_extract engine:paddleocr lang:zh-cn
  3.watermark text:"内部文件" opacity:0.1 position:diagonal
  4.encrypt aes256 password:proj2026!
  5.compress level:high
output: contract_final.pdf

## OCR引擎选择
--ocr tesseract 免费 中文95% | --ocr paddleocr 推荐 中文98%
--ocr azure 付费 最高精度 多语言99%+

性能: 合并50个PDF(200MB)→12秒 | OCR 100页→30秒
AES-256硬件加速加密 | 压缩率40-70%',
                'use_cases' => '文档合并拆分|OCR文字提取|电子合同签署|加密解密|加水印归档',
                'pros' => '✓ 批量处理前先用小样本（3-5个文件）跑一遍流水线确认参数无误，再投入全量运行
✓ OCR引擎根据文档类型选择 —— 扫描件用paddleocr，原生数字PDF用tesseract就够且更快
✓ 加密密码使用强密码（12位以上+大小写+数字+符号）并安全保管，忘记密码的PDF基本无法恢复
✓ 压缩操作放在最后一步 —— 先完成所有编辑操作再做压缩，避免反复压缩导致质量损失
⚠ 不要对已有数字签名的PDF做合并或修改操作 —— 会破坏签名有效性使文件失效
⚠ 不要期望OCR能完美处理手写体、盖章覆盖或低分辨率(<150dpi)扫描件 —— 准确率会大幅下降
⚠ 不要跳过输出预览 —— 尤其是格式转换操作（PDF→DOCX），排版偏移是最常见的投诉原因
⚠ 不要用在线版处理含敏感信息的文档 —— 始终优先选择本地离线处理引擎保护数据隐私',
                'author' => 'PDF Tools Team',
                'repo_url' => 'https://github.com/pdf-ai/master',
                'avg_rating' => 4.4,
                'install_count' => 120000,
                'likes_count' => 6500,
                'reviews_count' => 1400,
                'is_featured' => false,
            ],
            [
                'name' => 'Document Pro',
                'slug' => 'document-pro',
                'category' => 'productivity',
                'icon' => '📝',
                'short_desc' => 'Word文档自动化：报告/合同/论文/简历一键生成',
                'description' => '用自然语言生成格式规范的Word文档(.docx)。内置商业报告、学术论文(GB-T7713)、法律合同、求职简历等6大类模板。格式还原度达94%。',
                'install_steps' => '1. 安装 document-pro
2. 选择文档模板类型
3. 用自然语言描述内容要点和章节结构
4. AI生成完整docx文件下载',
                'config_code' => '# Document Pro 配置详解

## 模板类型
type:business_report 商业报告(封面+目录+正文+附录+致谢)
type:academic_paper 学术论文(APA/GB-T7713/MLA引用格式)
type:legal_contract 法律合同(条款式编号+签署栏+附件区)
type:resume 求职简历(STAR法则+ATS关键字优化)
type:project_proposal 项目标书(技术方案+报价明细+案例展示)
type:meeting_minutes 会议纪要(决策项+Action Items+截止日期)

## 实测示例：Q1经营分析报告
@document-pro type:business_report title:BestSkills Q1经营报告
content:
核心指标: DAU增长42% | Skills收录18个精选 | 社区活跃度+35%
关键成果: 完成Laravel平台搭建上线10个功能页面
下季度规划: 用户系统+Livewire组件化+Vercel部署
include_toc:true format:a4 font:思源宋体 heading_font:思源黑体

## 质量指标
格式还原度94%(vs人工排版) | 支持3级标题自动编号目录
GB-T7713/APA/MLA引用格式可选 | 中英文混排优化',
                'use_cases' => '商业报告|学术论文|法律合同|求职简历|项目标书|会议纪要|制度文档',
                'pros' => '✓ 提供结构化大纲后再展开正文 —— 先敲定一级二级标题框架，比直接扔一堆要点效果好得多
✓ 明确指定字体和格式要求，特别是中文场景下指定「思源宋体/黑体」避免系统回退到宋体/楷体
✓ 表格数据以CSV或Markdown表格形式提供输入，比散落在段落中的数字提取准确率高很多
✓ 生成后用 Word 的「比较模式」对照原稿检查，重点看页眉页脚、页码和目录链接是否正确
⚠ 不要期望它能完美处理复杂的嵌套表格（3层以上合并单元格）和浮动图片定位
⚠ 不要跳过最终人工审阅环节 —— 法律合同类文档的条款措辞必须由专业人士确认
⚠ 不要用默认模板应付正式场合的公文 —— 政府和学术机构通常有严格的版面格式规范需手动调
⚠ 不要在单次生成中要求超过20页的长文档 —— 分章节逐步生成再合并，质量更可控',
                'author' => 'Document AI Team',
                'repo_url' => 'https://github.com/doc-ai/pro',
                'avg_rating' => 4.3,
                'install_count' => 85000,
                'likes_count' => 4800,
                'reviews_count' => 920,
                'is_featured' => false,
            ],
            [
                'name' => 'PPT Master',
                'slug' => 'ppt-master',
                'category' => 'productivity',
                'icon' => '📽️',
                'short_desc' => 'PPT演示文稿AI生成器，10+商务风格一键出片',
                'description' => '输入主题和大纲要点，自动生成完整PPT演示文稿(.pptx)。内置深色现代、商务蓝、极简暖白、学术经典等10+风格配色方案。支持动画过渡、演讲备注和图表占位符。',
                'install_steps' => '1. 安装 ppt-master
2. 输入演讲主题和核心要点大纲
3. 选择视觉风格、目标页数和受众类型
4. AI生成完整pptx含动画和备注
5. 在PowerPoint/WPS中打开微调',
                'config_code' => '# PPT Master 配置详解

## 风格预设
style: modern_dark 深色现代(科技感渐变背景+霓虹强调色)
corporate_blue 商务蓝(稳重正式+深蓝主色调)
minimalist_warm 极简暖白(清新文艺+大量留白)
creative_bold 大胆创意(撞色排版+非对称布局)
academic_classic 学术经典(严谨简洁+灰蓝色系)
data_story 数据叙事(信息图密集+深浅双色对比)

## 实测示例：AI Agent商业化趋势报告
@ppt-master topic: AI Agent商业化趋势2026
大纲:
一、市场概况 $78.4亿→$526亿 CAGR 46.3%
二、主要玩家 Anthropic/OpenAI/Microsoft格局
三、商业化路径 SaaS订阅/技能包市场/企业安全服务
四、机会窗口 可观测性缺口/评测服务/中小企业落地
style: modern_dark slides:22 audience:投资人/创业者
include: transition_animations, chart_placeholders, speaker_notes, qa_slide

规格: 16:9宽屏兼容PPT2019+/WPS/GoogleSlides | 平均18页生成耗时约15秒',
                'use_cases' => '商业路演|内部培训课件|年度汇报|产品发布会|学术答辩|融资路演|方案汇报',
                'pros' => '✓ 提供的结构化大纲越详细，PPT的逻辑流畅度和信息密度越好 —— 至少写到三级标题
✓ 明确告知目标受众和场景 —— 给投资人看的和给内部培训看的，风格和信息深度完全不同
✓ 利用 speaker_notes 功能让AI为每页生成演讲提示词，上台前扫一遍心里就有底了
✓ 生成后替换品牌Logo和公司配色（全局查找替换主题色），这是最快让PPT看起来"像自家出品"的方法
⚠ 不要期望图表中的数据完全精确 —— 图表占位符需要你手动填入真实数据和调整坐标轴刻度
⚠ 不要在单份PPT中混用超过2种风格主题 —— 视觉一致性崩塌比内容问题更刺眼
⚠ 不要忽略母版(Slide Master)设置 —— 全局字体/页脚/Logo应该在母版中统一定义
⚠ 不要跳过动画效果的合理性检查 —— 过多或过于花哨的动画会分散观众注意力甚至引起反感',
                'author' => 'Presentation AI',
                'repo_url' => 'https://github.com/ppt-ai/master',
                'avg_rating' => 4.5,
                'install_count' => 110000,
                'likes_count' => 5900,
                'reviews_count' => 1300,
                'is_featured' => false,
            ],
            [
                'name' => 'Image Gen Pro',
                'slug' => 'image-gen-pro',
                'category' => 'creative',
                'icon' => '🖼️',
                'short_desc' => 'AI图像创作引擎，文生图/图生图/风格迁移/超分辨率',
                'description' => '全能图像创作引擎。支持文字描述生成图像（1024~2048分辨率）、图片编辑重绘、风格迁移和低分辨图超分增强(4x PSNR+8.2dB)。内置20+艺术风格关键词库。',
                'install_steps' => '1. 安装 image-gen-pro
2. 详细描述想要画面（主体+场景+光影+氛围）
3. 选择尺寸、质量和艺术风格
4. 生成后可迭代优化或局部重绘',
                'config_code' => '# Image Gen Pro 配置详解

## 生成模式
--create 文生图(默认) | --edit <image_path> 图生图编辑
--upscale <image_path> 超分辨率增强(2x/4x)
--style_transfer 风格迁移 | --inpaint <image> 局部重绘

## 尺寸与质量
1024×1024 正方形 | 1024×1536 竖版(手机壁纸)
1536×1024 横版(宽屏) | 2048×2048 高清打印
quality: standard(快速) | high(细节丰富)

## 风格关键词库(实测有效组合)
cinematic_lighting=电影级布光 | cyberpunk_neon=赛博朋克霓虹
watercolor_handpaint=水彩手绘 | isometric_3d=等距3D插画风
minimalist_clean=极简干净 | studio_portrait=影棚人像光
anime_ghibli=吉卜力动漫风 | oil_painting_impasto=油画厚涂

## 实测示例
@image-gen-pro --create --quality high size:1536×1026
prompt: 一只橘猫坐在东京涉谷十字路口 雨后路面霓虹招牌倒映
电影级布光 Leica M11 50mm f1.4 街拍风格 暗角

效果数据(N=5000用户): 文生图满意度87% | 图生图准确率91%
超分辨率4x PSNR提升8.2dB | 迭代2-3次满意率94%',
                'use_cases' => '社交配图|产品概念图|Logo灵感|文章头图|风格迁移|老照片修复|超分增强',
                'pros' => '✓ Prompt采用「主体+动作+场景+光线+镜头+风格」六要素结构化描述，比散乱关键词的效果好太多
✓ 善用参考图(图生图模式)来控制构图和姿态 —— 纯文字描述人物手势和空间关系经常翻车
✓ 超分辨率增强选4x而非2x —— 虽然慢一点但细节恢复效果明显更好，尤其适合后续印刷用途
✓ 不满意时用inpaint局部重绘而不是重新生成整张图 —— 只修有问题的区域效率高很多
⚠ 不要期望它能准确渲染文字内容 —— 包括中文英文标语、书名、车牌号，目前的文字能力都非常有限
⚠ 不要在单次Prompt中堆砌超过5个风格关键词 —— 相互矛盾的审美指令会让画面变得不伦不类
⚠ 不要用 high quality 模式批量生成大量图片 —— GPU资源消耗极大且大部分用途standard模式就够用
⚠ 不要忽略版权风险判断 —— 用于商业用途前确认生成内容的版权归属和肖像权问题',
                'author' => 'Creative AI Lab',
                'repo_url' => 'https://github.com/creative-ai/image-gen',
                'avg_rating' => 4.7,
                'install_count' => 280000,
                'likes_count' => 15600,
                'reviews_count' => 3200,
                'is_featured' => true,
            ],
            [
                'name' => 'Code Reviewer',
                'slug' => 'code-reviewer',
                'category' => 'development',
                'icon' => '🔎',
                'short_desc' => 'AI代码审查助手，Bug/安全漏洞/性能异味一网打尽',
                'description' => '专业的AI Code Review工具。自动检测潜在Bug、OWASP Top10安全漏洞、性能瓶颈（N+1查询/内存泄漏）和代码异味。支持15+编程语言，附修复代码建议。扫描速度2000行/秒，CI/CD开箱即用。',
                'install_steps' => '1. 安装 code-reviewer
2. 配置目标编程语言和审查级别
3. 可集成到GitHub Actions CI/CD流水线
4. 查看分级报告按优先级修复',
                'config_code' => '# Code Reviewer 配置详解

## 审查级别
level quick 仅Critical+High(30秒快速扫描)
level standard C/H/M三级全覆盖(推荐日常使用)
level strict 含Info和Style规范(代码提交前终极审查)

## 聚焦维度
focus security OWASP Top10 CWE漏洞映射
focus performance N+1查询/内存泄漏/算法复杂度
focus bugs 空指针/越界/并发竞争/资源泄漏
focus code_smell 过长函数/上帝类/重复代码/深层嵌套
focus style PSR/PEP8/Airbnb/ESLint规范检查

## 实战示例：Laravel项目安全+性能双检
@code-reviewer lang php level:strict focus:security,performance,bugs
path: app/Http/Controllers/ exclude: vendor/,tests/
output_format: markdown_with_fix

## 报告样例
[CRITICAL] SQL注入 UserController.php:42
用户输入直接拼接到SQL查询字符串 | CVSS评分 9.8(严重)
修复方案: User::findOrFail($id) // ORM自动参数绑定

[MEDIUM] N+1查询 OrderController.php:88
foreach循环内执行关联模型查询
修复: Order::with([\'items\',\'customer\'])->get() // 预加载

扫描速度~2000行/s | OWASP覆盖率100% | 误报率~8%
CI/CD集成: GitHub Actions/GitLab CI/Jenkins 零配置',
                'use_cases' => 'PR自动审查|安全漏洞扫描|性能瓶颈检测|编码规范检查|技术债务标记',
                'pros' => '✓ 第一次接入项目时用 strict 级别跑全量扫描建立基线，之后日常用 standard 级别做增量审查
✓ 把 vendor/、node_modules/，tests/ 加入排除列表 —— 第三方代码和测试文件的噪音会淹没真正的问题
✓ 关注修复代码的可操作性 —— 好的Review不仅是指出问题，更要给出可直接应用的修复diff
✓ 将Code Reviewer集成到PR的必查流程中，Critical/High问题阻断合并直到修复确认
⚠ 不要完全替代人工Code Review —— 它擅长找模式和规则类问题，但对业务逻辑正确性的判断力有限
⚠ 不要忽略误报的管理 —— 约8-10%的报告可能是误报，建立团队白名单机制避免反复讨论同类问题
⚠ 不要在未经优化的巨型单体仓库上直接跑 full scan —— 先按模块分治否则可能耗尽内存或超时
⚠ 不要把修复建议当圣经照搬 —— AI给出的修复方案未必符合你们的架构设计和编码惯例，需要人工判断采纳',
                'author' => 'DevTools Community',
                'repo_url' => 'https://github.com/devtools/code-reviewer',
                'avg_rating' => 4.8,
                'install_count' => 230000,
                'likes_count' => 13400,
                'reviews_count' => 2900,
                'is_featured' => true,
            ],
            [
                'name' => 'SQL Expert',
                'slug' => 'sql-expert',
                'category' => 'development',
                'icon' => '🗄️',
                'short_desc' => '自然语言写SQL，查询优化与数据库设计顾问',
                'description' => '用自然语言描述数据需求，自动生成高效SQL查询语句。具备EXPLAIN执行计划解读、索引推荐、Schema规范化评审等专业能力。支持MySQL/PostgreSQL/SQLite/SQLServer。自然语言转SQL准确率94%。',
                'install_steps' => '1. 安装 sql-expert
2. 连接目标数据库（或使用离线模式）
3. 用自然语言描述查询需求和业务逻辑
4. 获得优化SQL + EXPLAIN分析 + 索引建议',
                'config_code' => '# SQL Expert 配置详解

## 方言支持
--dialect mysql / postgresql / sqlite / sqlserver / oracle

## 核心能力
1. 自然语言→SQL转换（准确率94%）
2. EXPLAIN执行计划解读与优化建议
3. 智能索引推荐（覆盖哪些查询场景）
4. Schema规范化评审（3NF vs 反规范化权衡）
5. 慢查询日志批量分析与优先级排序

## 实测示例：销售数据分析
@sql-expert --dialect mysql --optimize true --with-explain
查询上个月各品类销售额Top10 并对比去年同期增长率
--- 输出 ---
完整SQL语句(带别名和注释)
EXPLAIN分析结果(type/ref/rows/key解读)
索引建议: 建议加复合索引 idx_category_date(category_id, order_date)
优化前后: 12ms → 3ms(下降75%)

## 安全保障
所有生成的SQL自动注入防护检查 | 不执行DROP/TRUNCATE/DELETE无条件语句
危险操作需二次确认',
                'use_cases' => '自然语言生成SQL|慢查询优化诊断|数据库Schema设计|索引策略|数据迁移脚本',
                'pros' => '✓ 提供 CREATE TABLE 语句或Schema快照作为上下文 —— 让AI了解表结构和字段类型，生成SQL的准确率从78%飙升到94%
✓ 复杂查询先让它解释执行计划(EXPLAIN)再优化，比直接凭感觉改SQL靠谱得多
✓ 索引建议拿到后先用 EXPLAIN 验证预期效果，再决定是否真的要在生产库上创建
✓ 涉及 UPDATE/DELETE 时始终加上 WHERE 子句预览受影响行数，防止误操作清空表
⚠ 不要让它直接在生产数据库上执行写操作 —— 始终先在测试环境或事务内验证再部署
⚠ 不要期望它能完美处理超过5层嵌套的子查询或极度复杂的CTE递归 —— 这种情况建议拆分成临时表+多步执行
⚠ 不要忽略数据量级的差异 —— 在100行测试数据上跑得飞快的SQL到了1000万行生产表可能完全不同
⚠ 不要盲目接受所有索引建议 —— 每个额外索引都会减慢写入速度，需要权衡读写比例',
                'author' => 'Data Community',
                'repo_url' => 'https://github.com/data-ai/sql-expert',
                'avg_rating' => 4.6,
                'install_count' => 175000,
                'likes_count' => 9800,
                'reviews_count' => 2100,
                'is_featured' => true,
            ],
            [
                'name' => 'Git Helper',
                'slug' => 'git-helper',
                'category' => 'development',
                'icon' => '🔀',
                'short_desc' => 'Git版本控制专家，冲突解决/提交整理/分支管理',
                'description' => '用自然语言描述版本控制需求，自动生成git命令序列。擅长三方merge冲突解决、commit history整理(squash/rebase)、Git Flow分支策略和Release发布流程。冲突解决成功率89%。',
                'install_steps' => '1. 安装 git-helper
2. 用自然语言描述你要完成的Git操作
3. 复制命令手动执行或开启auto模式自动执行(需确认)
4. 每一步都有交互式确认提示',
                'config_code' => '# Git Helper 配置详解

## 操作类别
conflict 冲突解决(智能三方合并策略 ours/theirs/手动)
history 提交历史整理(squash/rebase/cherry-pick/interactive rebase)
branch 分支策略(Git Flow/Trunk Based/GitHub Flow)
release 发布流程(tag语义化版本/Changelog生成/合并到main)

## 安全模式
--safe(仅输出命令默认) / --auto(自动执行需确认) / --dry-run(模拟预览不执行)

## 实战示例
# 冲突解决
git-helper resolve conflict in UserForm.tsx strategy:ours-for-styling theirs-for-logic

# 提交压缩
git-helper squash last 5 commits into one message:"feat: add user auth with JWT tokens and refresh flow"

# 版本发布
git-helper release v2.1.0 from develop include:changelog,tag,merge-to-main format:conventional-commits

## 效果数据
冲突解决成功率89% | squash/rebase准确率99%
Changelog 100%符合 Conventional Commits 规范',
                'use_cases' => 'Merge冲突解决|Commit历史整理|分支策略管理|Changelog生成|版本发布流程',
                'pros' => '✓ 解决冲突前先让AI分析双方改动意图，而不是盲目选择 ours 或 theirs —— 理解为什么冲突比解决冲突更重要
✓ squash前仔细检查被合并的commits是否有关联的PR或issue引用 —— 压缩后这些关联信息会丢失
✓ release流程始终用 --dry-run 先预览完整的命令列表和Changelog草稿，确认无误再正式执行
✓ 团队约定好 commit message 格式（推荐Conventional Commits）并写入Git Hook模板，让每次提交都规范化
⚠ 不要开启 --auto 模式操作 force push —— 即使AI判断应该force push，也必须由人工确认才能执行
⚠ 不要指望它能解决二进制文件的冲突（图片、字体、压缩包）—— 这类冲突必须手动选择保留哪个版本
⚠ 不要在公共分支上做 interactive rebase 且改变已经push过的 commits —— 会给队友带来巨大的麻烦
⚠ 不要忽略 rebase 前的 stash 检查 —— 有未提交的更改时rebase会产生难以理解的合并冲突',
                'author' => 'DevOps Community',
                'repo_url' => 'https://github.com/devops/git-helper',
                'avg_rating' => 4.7,
                'install_count' => 190000,
                'likes_count' => 10500,
                'reviews_count' => 2300,
                'is_featured' => false,
            ],
            [
                'name' => 'Docker Pilot',
                'slug' => 'docker-pilot',
                'category' => 'devops',
                'icon' => '🐳',
                'short_desc' => 'Docker容器编排专家，一键生成Dockerfile/docker-compose',
                'description' => '根据项目技术栈自动生成最优Dockerfile和多阶段构建配置。内置镜像体积优化（平均缩小60%）、.dockerignore智能生成和CI/CD容器编排。支持Laravel/Node/Python/Rust/Go等20+技术栈自动识别。',
                'install_steps' => '1. 安装 docker-pilot
2. 扫描项目根目录（自动识别技术栈和依赖）
3. 自动生成Dockerfile + docker-compose.yml
4. docker-compose up -d 一键启动全部服务',
                'config_code' => '# Docker Pilot 配置详解

## 核心能力
自动识别20+技术栈(Laravel/Rails/Next.js/Django/Rust/Fiber等)
多阶段构建优化(镜像体积平均缩小60%)
.dockerignore智能排除(避免无用文件增大镜像层)
docker-compose多服务编排(app/db/cache/queue/frontend)
CI/CD容器集成(GitHub Actions/GitLab CI/Cloud Build)

## 实战示例：Laravel全栈项目容器化
@docker-pilot scan:. optimization:multi_stage production_ready:true services:[app,mysql,redis,frontend]

--- 输出 ---
Dockerfile (composer依赖缓存层 + npm build层 + nginx+php-fpm运行层)
镜像体积: 1.2GB基础镜像 → 180MB最终产物(缩小85%)
docker-compose.yml (4服务编排 + 网络隔离 + 数据卷持久化)
健康检查探针 | 日志驱动配置 | 资源限制(cpus/memory)

## 性能指标
镜像构建缓存命中率85% | 冷启动时间<5s
支持20+主流技术栈零配置识别',
                'use_cases' => 'Dockerfile生成|多服务Compose编排|镜像瘦身优化|CI/CD容器化|开发环境标准化',
                'pros' => '✓ 让它扫描完整的项目目录而不仅仅是 package.json 或 composer.json —— 隐藏的技术栈线索可能在 .tool-versions 或 Dockerfile 里
✓ 多阶段构建务必把构建依赖和运行依赖分离 —— node_modules/npm-cache 不应该出现在最终的运行镜像里
✓ 生成后用 docker image ls && docker history <image> 检查每一层的大小，找出意外的臃肿层并优化
✓ compose文件中始终定义 healthcheck 探针 —— 没有健康检查的服务编排在重启和扩缩容时会出各种诡异问题
⚠ 不要直接复制生成的 Dockerfile 到生产环境而不理解每一行指令的含义 —— 特别是 USER/ROOT 权限和 exposed 端口
⚠ 不要忽略 .dockerignore 文件 —— 一个遗漏的 .env 或 node_modules 可能让镜像莫名增大几百MB
⚠ 不要在 Windows/macOS 上构建后直接部署到 Linux 生产环境 —— 交叉平台的层缓存可能导致镜像不一致
⚠ 不要把数据库的数据卷定义为 bind mount 而不用 named volume —— 前者在Windows和Mac上的性能极差',
                'author' => 'DevOps Community',
                'repo_url' => 'https://github.com/devops/docker-pilot',
                'avg_rating' => 4.6,
                'install_count' => 160000,
                'likes_count' => 8700,
                'reviews_count' => 1900,
                'is_featured' => true,
            ],
            [
                'name' => 'Security Guard',
                'slug' => 'security-guard',
                'category' => 'security',
                'icon' => '🛡️',
                'short_desc' => '代码安全审计员，OWASP Top10+密钥泄露+CVE漏洞扫描',
                'description' => '专注代码安全的AI审计工具。自动扫描OWASP Top10类漏洞、硬编码密钥(AWS/GitHub/数据库密码)、依赖包CVE漏洞(NVD库每日更新)。输出SARIF格式报告兼容GitHub IDE。误报率仅约5%。',
                'install_steps' => '1. 安装 security-guard
2. 配置扫描路径和规则集组合
3. 集成到CI/CD流水线或在本地运行
4. 查看安全报告按CVSS评分优先级修复',
                'config_code' => '# Security Guard 配置详解

## 规则集
--rules owasp10 OWASP Top10(注入/XSS/CSRF/SSRF/反序列化等)
--rules secrets 密钥硬编码检测(AWS AKIA/Github ghp_/JWT/DB连接串)
--rules cve 依赖包CVE漏洞(NVD国家漏洞数据库 每日同步更新)
--rules sast 静态分析(路径穿越/XXE/不安全的反序列化/SSRF)

## 严重等级
critical CVSS 9.0-10.0 | high 7.0-8.9 | medium 4.0-6.9 | low 0.1-3.9

## 实战示例
@security-guard --scan-path src/ --rules owasp10,secrets,cve
--severity critical,high --format sarif --output report.sarif

## 报告样例
[CRITICAL] SQL注入(CWE-89) UserController.php:42
$_GET[\'id\'] 直接拼接至SQL查询字符串
CVSS评分: 9.8(严重) | 修复: User::findOrFail($id)

[HIGH] AWS Access Key硬编码 config/aws.php:12
检测到AKIA开头凭证格式 | 建议: 移除并使用IAM角色或环境变量

[MEDIUM] Log4j CVE-2021-44228 composer.lock:189
dependency log4j version 1.2.17 存在远程代码执行漏洞
修复: 升级至 log4j 2.17.1+

# OWASP覆盖率100% | CVE库每日同步 | SARIF兼容GitHub Security Tab
# 误报率约5% | 平均扫描速度1500行/秒',
                'use_cases' => 'OWASP漏洞扫描|密钥硬编码检测|依赖包CVE审查|合规审计|DevSecOps流水线',
                'pros' => '✓ 首次接入新项目时用全部规则集跑一遍建立安全基线，重点关注 Critical 和 High 级别的漏洞
✓ secrets 规则集配合 pre-commit hook 使用能在代码推送到远程仓库前就拦截凭证泄露
✓ CVE 漏洞报告出来后立刻在所有项目中跑一轮 dependency audit —— 不要等到下次计划的安全扫描
✓ SARIF 格式的报告直接上传到 GitHub Security Tab，可以在 PR 中直观地看到新增 vs 已修复的安全问题
⚠ 不要以为没有 Critical 级别的报告就是安全的 —— Medium 级别的 XSS 和 CSRF 组合利用同样可以造成严重后果
⚠ 不要忽略 dependencies 目录外的手动下载的库文件 —— 很多CVE漏洞恰恰藏在那些不被包管理器管理的第三方SDK里
⚠ 不要在未打补丁的老旧运行环境上运行 —— 如果你的PHP还是7.4以下，再多静态扫描也防不住已废弃函数的漏洞
⚠ 不要把安全扫描当成一次性任务 —— 建议每周至少一次定期扫描，因为新的CVE漏洞每天都在被发现',
                'author' => 'Security Community',
                'repo_url' => 'https://github.com/security-ai/guard',
                'avg_rating' => 4.8,
                'install_count' => 210000,
                'likes_count' => 14200,
                'reviews_count' => 2600,
                'is_featured' => true,
            ],
            [
                'name' => 'Workspace Sync',
                'slug' => 'workspace-sync',
                'category' => 'productivity',
                'icon' => '🔄',
                'short_desc' => '工作空间消息聚合：Slack/Notion/飞书/Teams统一收口',
                'description' => '将Slack、Notion、飞书(Lark)、Discord、Microsoft Teams等多平台消息聚合到一个统一界面。AI自动总结重要通知、草拟回复建议、提取Action Items并按优先级排序。端到端加密传输。',
                'install_steps' => '1. 安装 workspace-sync
2. OAuth授权连接各平台账号
3. 配置关注频道/空间和关键词过滤规则
4. 开始接收统一消息流和AI摘要',
                'config_code' => '# Workspace Sync 配置详解

## 支持平台
Slack / Notion / 飞书 Lark / Discord / Microsoft Teams
GitHub(issues/PR notifications) / Google Calendar / Email(IMAP)

## 实战示例
@workspace-sync --connect slack,notion,feishu,teams
--channels #general,#dev-team,#product,#urgent
--keywords urgent,p0,due today,@mention,blocker,deploy
--summary_mode daily_digest time:09:00
--priority_rules "含urgent/p0/blocker的置顶显示"

## 核心功能
1. 多平台消息聚合(统一时间线 消除来回切换)
2. AI摘要提炼(重要通知→3句话总结+行动项)
3. 回复草拟(基于上下文智能生成回复建议供审核)
4. Action Item提取(待办事项+负责人+截止日期 自动归类)
5. 优先级智能排序(紧急>重要>普通 基于关键词和发送者权重)

## 效果数据(企业用户反馈N=1200)
信息过载感降低65% | 重要消息响应速度提升40%
每日节省切换应用时间约45分钟 | 端到端E2E加密传输',
                'use_cases' => '多平台消息聚合|会议纪要自动生成|待办事项提取|智能回复草拟|团队状态同步',
                'pros' => '✓ 初次配置时只连接2-3个最高频的平台，跑稳了再加新的 —— 一口气全开会让初始噪音大到无法忍受
✓ 设置关键词过滤规则时要包含正向和负向两种 —— 既要关注 @mention 和 blocker，也要屏蔽 bot 通知和无意义的 reaction
✓ 每天花5分钟训练它的优先级判断 —— 对AI错误分类的消息手动纠正几次后它会越来越准
✓ 开启daily_digest模式并在每天早上固定时间推送前一天的重要汇总，比实时推送更适合管理者
⚠ 不要给它过高的API权限 —— 只授予读取消息的基本scope，不要给予发消息或删除消息的权限
⚠ 不要在未告知团队成员的情况下启用自动回复功能 —— 未审核的AI回复可能造成严重的沟通事故
⚠ 不要期望它能完美理解每个公司的黑话和缩写 —— 内部术语需要在配置中显式声明映射关系
⚠ 不要忽略数据驻留和合规问题 —— 欧盟GDPR和某些行业规定要求数据不得跨境传输，注意服务器节点位置',
                'author' => 'Workspace Tools Team',
                'repo_url' => 'https://github.com/workspace-tools/sync',
                'avg_rating' => 4.4,
                'install_count' => 98000,
                'likes_count' => 5600,
                'reviews_count' => 1200,
                'is_featured' => false,
            ],
            [
                'name' => 'Prompt Engineer',
                'slug' => 'prompt-engineer',
                'category' => 'productivity',
                'icon' => '✍️',
                'short_desc' => '提示词工程专家，CoT/Few-Shot优化与A/B效果测试',
                'description' => '专业的Prompt质量分析和优化工具。自动评估Prompt得分(0-100)，提供结构化改进建议包括思维链(CoT)、Few-Shot示例注入、角色设定强化和约束条件显式化。支持A/B对比测试量化优化效果。',
                'install_steps' => '1. 安装 prompt-engineer
2. 粘贴原始Prompt文本
3. AI分析质量问题并给出多维评分
4. 应用优化策略并获得改进版Prompt
5. A/B测试验证效果差异',
                'config_code' => '# Prompt Engineer 配置详解

## 优化策略
--opt cot 注入Chain-of-Thought思维链(逐步推理步骤)
--opt few_shot 增加Few-Shot少样本示例(输入→输出对)
--opt role_play 强化角色设定和专业背景约束
--opt constraint 显式化约束条件和边界情况
--opt output_format 规范输出格式(JSON schema/XML/Markdown table)

## 实测示例
@prompt-engineer --analyze optimizations:[cot,few_shot,role_play,constraint] compare:true
原始Prompt: "帮我写一段Python代码"
--- 分析结果 ---
原始评分: 42/100 (缺乏约束/无示例/角色模糊/输出格式不明)
优化后评分: 87/100

优化后的Prompt包含:
🎯 角色设定: 你是一位拥有15年经验的Python高级工程师，专精数据处理和自动化脚本
💭 CoT思维链: 1.分析输入数据格式 2.确定处理逻辑 3.编写核心函数 4.添加异常处理 5.撰写Docstring
📝 Few-Shot示例: Input:[1,2,3] → Output:[1,4,9] (平方映射)
🔒 约束条件: 必须使用Type Hint | 包含完整异常处理 | 兼容Python 3.10+
📦 输出格式: 代码块+时间/空间复杂度分析+使用示例

## A/B测试数据(N=2000次对比测试)
CoT注入: 准确率提升35% | Few-Shot: 幻觉率降低60%
角色设定: 专业度感知提升28% | 约束条件: 边界case处理改善50%
组合使用(4种策略全开): 综合满意度从42分提升至87分',
                'use_cases' => 'Prompt质量评估|结构化重写|CoT思维链注入|Few-Shot示例生成|效果A/B对比测试',
                'pros' => '✓ 先用原始Prompt跑一轮得到基准分数，再逐项添加优化策略观察单项得分变化 —— 这样你知道哪个策略对你的场景贡献最大
✓ Few-Shot示例必须是真实的输入输出对，不要编造 —— 编造的示例会误导模型反而降低输出质量
✓ CoT步骤控制在3-5步以内 —— 太长的思维链会在中间步骤产生累积误差导致最终答案跑偏
✓ 对优化后的Prompt做A/B测试时至少准备5组不同的测试用例，单例测试的结果偶然性太大
⚠ 不要盲目追求高分 —— 90分以上的Prompt往往过于冗长冗余，在实际使用中会增加token成本和延迟
⚠ 不要忽略领域知识的注入 —— Prompt工程技巧再好也无法弥补对特定行业认知的不足
⚠ 不要对不同模型使用同一套优化后的Prompt —— GPT-4o/Claude/Gemini各自有不同的最优Prompt模式
⚠ 不要在优化过程中丢失原始意图 —— 过度结构化有时会让Prompt变得机械僵硬失去灵活性',
                'author' => 'Prompt Engineering Lab',
                'repo_url' => 'https://github.com/prompt-ai/engineer',
                'avg_rating' => 4.7,
                'install_count' => 195000,
                'likes_count' => 11800,
                'reviews_count' => 2400,
                'is_featured' => false,
            ],
            [
                'name' => 'Translate Pro',
                'slug' => 'translate-pro',
                'category' => 'productivity',
                'icon' => '🌍',
                'short_desc' => '专业翻译引擎，100+语言/术语一致/格式原样保留',
                'description' => '超越普通翻译工具的专业级翻译引擎。支持100+语言互译、术语表一致性维护(Glossary)、文档格式原样保留(docx/pdf/html/markdown)。BLEU评分行业领先水平。适配技术/法律/营销/学术等多种文体风格。',
                'install_steps' => '1. 安装 translate-pro
2. 选择源语言和目标语言
3. 上传文件或粘贴文本内容
4. 设置领域模式和术语偏好文件',
                'config_code' => '# Translate Pro 配置详解

## 语言覆盖(100+)
重点优化语言对: 中英/中日/中韩/英法/英德/英西/英阿/英俄/英葡

## 领域模式
domain:technical 技术文档(代码块/术语/API名称保留原文不译)
domain:legal 法律合同(严谨正式语气/法务用语规范)
domain:marketing 营销文案(本地化创意改编/不只是直译)
domain:academic 学术论文(引用格式规范/术语统一)
domain:casual 日常对话(自然口语化/避免翻译腔)

## 实测示例：API技术文档英译中
@translate-pro source:en-us target:zh-cn domain:technical
term_file:glossary.csv style:formal
file:api_documentation.docx

## 术语表示例(glossary.csv)
rate limiting → 限流 (强制不译!)
endpoint → 端点 (强制不译!)
deployment → 部署 (强制不译!)
throughput → 吞吐量 (强制不译!)

## 格式保持能力
docx: 排版/表格/图片位置/页眉页脚 100%保留
pdf: 布局/分栏/图文环绕 95%+保留
html/markdown: 标签结构/代码块/链接 100%保留

# BLEU评分: 42.3(行业领先) | 术语一致率: 99.2% | 支持批量多文件并行处理',
                'use_cases' => '技术文档国际化|法律合同翻译|营销文案本地化|API文档多语言|学术论文翻译',
                'pros' => '✓ 始终提供术语表(glossary.csv)文件 —— 哪怕只有十几个术语，也能将专业翻译的准确度从80%提升到97%+
✓ 技术文档翻译时明确标注哪些内容不应翻译（变量名/函数名/API路径/命令行参数）
✓ 营销类文案选择 marketing domain 而非 general —— 它会做文化适应性调整而不只是字面直译
✓ 长文档翻译后抽查3-5个关键段落做人工校对，重点关注数字、日期和人名地名的准确性
⚠ 不要用它处理高度专业化的医学或法律文本而不做人工复审 —— 错误的代价在这些领域极其高昂
⚠ 不要期望方言俚语和网络梗能翻译到位 —— 这些高度依赖文化语境的内容机器翻译基本做不到自然
⚠ 不要在翻译前不清理源文档中的乱码和特殊字符 —— 它们会被当作正常内容"翻译"出更离谱的结果
⚠ 不要忽略译文的文化敏感性检查 —— 某些颜色/手势/隐喻在目标文化中可能有完全相反的含义',
                'author' => 'Translation AI Team',
                'repo_url' => 'https://github.com/trans-ai/pro',
                'avg_rating' => 4.5,
                'install_count' => 140000,
                'likes_count' => 7800,
                'reviews_count' => 1700,
                'is_featured' => false,
            ],
            [
                'name' => 'Vibe Security',
                'slug' => 'vibe-security',
                'category' => 'security',
                'icon' => '🔒',
                'short_desc' => '自动化安全漏洞扫描，SQL注入/XSS/CSRF检测与修复',
                'description' => 'Skillstore评分最高的安全类Skill(74分)。自动扫描代码中的安全漏洞包括SQL注入、XSS跨站脚本、CSRF跨站请求伪造、路径穿越等常见OWASP漏洞类型。支持15+编程语言，并提供带有详细解释的安全修复代码建议。',
                'install_steps' => '1. 安装 vibe-security 到 Claude Code
2. 在项目根目录运行 @vibe-security --scan
3. 查看漏洞报告按CVSS严重程度排序
4. 应用推荐的修复补丁',
                'config_code' => '# Vibe Security 配置详解

## 扫描能力
支持的漏洞类型:
- SQL Injection (CWE-89) 注入攻击检测
- XSS Cross-Site Scripting (CWE-79) 跨站脚本漏洞
- CSRF (CWE-352) 跨站请求伪造检测
- Path Traversal (CWE-22) 目录穿越漏洞
- Command Injection (CWE-78) OS命令注入
- SSRF (CWE-918) 服务端请求伪造
- Insecure Deserialization (CWE-502) 不安全反序列化
- Authentication Bypass (WEAKNESS-287) 认证绕过

支持的语言: Python/JavaScript/TypeScript/Go/Rust/Java/Ruby/PHP/C#/C++ 等15+

## 使用方式
@vibe-security --scan ./src --lang python --severity critical,high,medium
@vibe-security --scan ./src --fix auto (自动应用修复补丁 需确认)
@vibe-security --report json security-report.json (导出JSON报告)

## 实测效果
平均扫描速度: ~1800行/秒 | 漏洞检出率: 92%
误报率: ~7% | 修复建议可用率: 85%
CI/CD集成: GitHub Actions/GitLab CI 零配置',
                'use_cases' => '代码安全审计|OWASP漏洞扫描|CI/CD安全门禁|合规检查|安全培训教学',
                'pros' => '✓ 首次接入新仓库时用 --severity all 跑一次全量扫描，建立项目的安全基线和漏洞分布热力图
✓ 结合 pre-commit hook 在每次代码提交前自动扫描变更文件，将安全问题拦截在合并之前
✓ 不要只看漏洞数量，关注 CVSS 评分 —— 一个 Critical(9.8) 比十个 Low(2.0) 更值得优先修复
✓ 导出的 JSON/SARIF 报告可以直接导入 GitHub Security Tab 或 GitLab Dependency Scanning 界面
⚠ 不要在没有代码上下文的孤立文件上运行扫描 —— 它需要理解数据流向才能准确判断漏洞真实性
⚠ 不要完全信任 auto-fix 自动修复 —— 每个 auto-fix 都需要人工review确认不会引入新的回归问题
⚠ 不要忽略依赖链传递漏洞 —— 有时候你的直接依赖没问题，但间接依赖存在已知CVE
⚠ 不要用它替代专业渗透测试 —— 静态分析只能发现模式化漏洞，逻辑缺陷和业务层面漏洞需要人工安全专家',
                'author' => 'Security Research Team',
                'repo_url' => 'https://github.com/security-ai/vibe-security',
                'avg_rating' => 4.7,
                'install_count' => 135000,
                'likes_count' => 9200,
                'reviews_count' => 1950,
                'is_featured' => true,
            ],
            [
                'name' => 'Frontend Dev Guidelines',
                'slug' => 'frontend-dev-guidelines',
                'category' => 'development',
                'icon' => '⚛️',
                'short_desc' => 'Next.js 15前端开发规范，React 19+TS+TailwindCSS最佳实践',
                'description' => '针对最新技术栈的前端开发规范指南。覆盖Next.js 15、React 19、TypeScript 5.x、Shadcn/ui、TailwindCSS v4的最佳实践。确保代码可维护性、高性能和一致的架构模式。Skillstore评分72分。',
                'install_steps' => '1. 安装 frontend-dev-guidelines 到项目
2. 运行 @frontend-dev-guidelines init 初始化配置
3. 根据项目技术栈选择对应的规则子集
4. 在CI/CD中集成自动检查',
                'config_code' => '# Frontend Dev Guidelines 配置详解

## 技术栈覆盖
核心: Next.js 15(App Router) / React 19 / TypeScript 5.x
样式: TailwindCSS v4 / Shadcn/ui / CSS Variables
状态: Server Components / Suspense / use() hook
测试: Vitest / Testing Library / Playwright E2E
质量: ESLint 9 flat config / Prettier 3 / Husky lint-staged

## 规则子集
--profile react_core React Hooks规则(依赖顺序/自定义Hook命名/状态提升原则)
--profile nextjs_best Next.js规范(Server Component划分/数据获取策略/路由组织)
--profile typescript_strict TS严格模式(noAny/显式返回类型/ discriminated union)
--profile tailwind_css Tailwind规范(原子类组织/responsive断点/dark-mode实现)
--profile accessibility a11y规则(ARIA属性/键盘导航/color contrast/focus management)
--profile performance 性能规则(Bundle分析/图片优化/Code Splitting/虚拟列表)

## 实测示例
@frontend-dev-guidelines check ./src --profile nextjs_best,typescript_strict,accessibility --fix

输出:
[ERROR] UserProfile.tsx:23 - Client Component中使用getServerSideProps(已废弃)
建议: 改用async Server Component或fetch with cache

[WARN] Button.tsx - 缺少focus-visible样式(键盘用户无法区分焦点状态)
建议: 添加 .focus-visible:focus-visible { outline: 2px solid blue; }

[INFO] Dashboard.tsx - 列表超过50项建议使用virtualization
建议: 引入@tanstack/react-virtual或react-window

## 效果数据
首次检查平均检出15-25个问题 | 修复后Bundle Size平均减小18%
a11y WCAG合规率 52% → 88% | 团队代码review时间减少40%',
                'use_cases' => '新项目脚手架规范|代码质量门禁|技术栈升级迁移|团队编码规范统一|性能优化审计',
                'pros' => '✓ 新项目启动时就初始化规范配置 —— 比后期强行引入规范的阻力小得多，团队接受度更高
✓ 根据团队实际技术栈选择规则子集，不要全量开启 —— Next.js项目不需要Vue的规则，反之亦然
✓ 把 guidelines 集成到 CI 的 PR 流程中，Critical/Error 级别的问题阻止合并直到修复
✓ 定期(每月)review和更新规则版本 —— 前端生态迭代快，3个月前的最佳实践可能已经过时
⚠ 不要盲目遵循所有规则而不理解背后的原因 —— 某些规则在你的特定场景下可能不适用或不必要
⚠ 不要忽略渐进式 adopting 策略 —— 对于遗留代码库，先从 warn 级别开始逐步收紧到 error
⚠ 不要用它替代代码 review 中的人的判断 —— 它能发现模式违规但无法判断架构决策是否合理
⚠ 不要在 rules 配置中硬编码团队偏好 —— 使用共享配置文件(.editorconfig/eslint.config.js)并纳入版本控制',
                'author' => 'Frontend Community',
                'repo_url' => 'https://github.com/frontend-ai/dev-guidelines',
                'avg_rating' => 4.6,
                'install_count' => 168000,
                'likes_count' => 10100,
                'reviews_count' => 2200,
                'is_featured' => true,
            ],
            [
                'name' => 'Create PR',
                'slug' => 'create-pr',
                'category' => 'development',
                'icon' => '🔀',
                'short_desc' => 'GitHub PR自动化，状态检查/提交/推送/创建一站式',
                'description' => '自动化GitHub Pull Request完整工作流。自动运行状态检查(lint/test/build)、规范commit message格式化、推送到远程分支并通过gh CLI创建PR，支持自定义PR模板和多语言(含日语)。大幅简化团队协作流程。Skillstore评分70分。',
                'install_steps' => '1. 安装 create-pr skill
2. 确保 gh CLI 已登录(gh auth login)
3. 在feature分支完成代码修改
4. 运行 @create-pr 自动完成提交流水线',
                'config_code' => '# Create PR 配置详解

## 工作流步骤(全自动)
1. git status 检查变更文件
2. 运行 lint + test + build (可自定义命令)
3. git add + git commit (自动生成conventional commit message)
4. git push origin feature/xxx
5. gh pr create (自动填充title/body/template/labels/reviewers)

## 配置选项
--template .github/pull_request_template.md 自定义PR模板
--base develop 指定目标分支(默认main)
--reviewers @alice,@bob 自动指派审查者
--labels bug,needs-review 自动添加标签
--draft 创建为Draft PR(草稿模式 不通知审查者)
--wip 标记为Work In Progress

## Commit Message规范
自动遵循 Conventional Commits:
feat: 新功能 | fix: Bug修复 | docs: 文档变更
style: 格式调整 | refactor: 重构(不改变行为)
perf: 性能优化 | test: 测试相关 | chore: 构建/工具链

## 实测示例
@create-pr --base main --reviewers @senior-dev --labels enhancement --template pr-template.md
--- 输出 ---
✓ Running npm run lint... PASSED (0 errors)
✓ Running npm run test... PASSED (47/47 tests)
✓ Running npm run build... PASSED (build in 12.3s)
📝 Committed: feat(user): add OAuth2 login with Google provider (#142)
🚀 Pushed to: origin feature/oauth-login
📋 PR created: https://github.com/org/repo/pull/143
👥 Reviewers assigned: @senior-dev
🏷️ Labels: enhancement

平均耗时: 45秒(含测试+构建) | PR创建成功率: 97%',
                'use_cases' => '日常PR创建|团队协作规范化|CI/CD前置检查|Commit Message标准化|自动化代码提交',
                'pros' => '✓ 配合 branch protection rules 使用 —— 强制要求 PR 通过 status checks 才能合并，形成完整的质量门禁闭环
✓ 自定义 PR 模板中加入 Checklist(测试/文档/性能影响)，让每个PR的信息完整性有保证
✓ 利用 draft PR 模式进行 WIP 开发 —— 代码还在写的时候就可以提前发起PR获得早期反馈
✓ 设置 auto-assign reviewers 规则让团队轮值，避免总是同几个人被分配到大量review任务
⚠ 不要在未配置 branch protection 的公开仓库上使用 —— 任何人都可以直接 push 到 main 让PR流程形同虚设
⚠ 不要跳过本地的 pre-push hooks 即使 create-pr 有自己的检查 —— 双重验证总比单层安全
⚠ 不要在 commit message 中包含敏感信息(API Key/密码/Token) —— PR 的 commit 历史对仓库有读取权限的人都可见
⚠ 不要忽略 large PR 的拆分建议 —— 如果变更超过400行或涉及多个独立功能，建议拆成多个小PR便于review',
                'author' => 'GitHub Automation Team',
                'repo_url' => 'https://github.com/github-automation/create-pr',
                'avg_rating' => 4.5,
                'install_count' => 125000,
                'likes_count' => 7600,
                'reviews_count' => 1680,
                'is_featured' => false,
            ],
            [
                'name' => 'Jira SAFE',
                'slug' => 'jira-safe',
                'category' => 'productivity',
                'icon' => '📋',
                'short_desc' => 'SAFe敏捷Jira管理，史诗/故事/子任务自动分层创建',
                'description' => '按照SAFe(Scaled Agile Framework)规模化敏捷标准自动创建和管理Jira问题。自动维护史诗(Epic)→故事(Story)→子任务(Task)的父子层级关系，自动生成正确的链接和描述格式。Skillstore评分71分。',
                'install_steps' => '1. 安装 jira-safe skill
2. 配置 Jira 连接(URL + API Token)
3. 选择 SAFe 项目配置和团队结构
4. 用自然语言描述需求，自动分解为Jira层次结构',
                'config_code' => '# Jira SAFE 配置详解

## SAFe 层级结构
Program Epic (PI级别的重大特性)
├── Feature (功能模块)
    └── Story (用户故事)
        ├── Task (技术子任务)
        └── Sub-task (细粒度工作项)

## 核心能力
1. 自然语言→Jira层次结构自动分解
2. 父子链接自动维护(Parent Link自动关联)
3. SAFe标准描述格式(Who/What/Why/Acceptance Criteria)
4. Story Points估算辅助(Fibonacci序列)
5. PI Planning导入(从PI Objectives批量创建Epics)

## 配置
@jira-safe --url https://your-org.atlassian.net
--token YOUR_JIRA_API_TOKEN
--project KEY --epic-name "PI Q2 Customer Portal Redesign"

## 实测示例
@jira-safe create epic:"客户门户重构" from:
我们需要重新设计客户自助服务门户，包括账户管理、订单跟踪和在线客服三个主要模块。目标是将客户自助解决问题率从35%提升到65%，同时将客服工单量减少40%。
--- 自动输出 ---
✓ Epic Created: PORTAL-101 客户门户重构
  ├─ Feature: PORTAL-102 账户管理中心重构 (8pts)
  │   ├─ Story: PORTAL-105 作为用户我希望修改个人资料 (3pts)
  │   ├─ Story: PORTAL-106 作为用户我希望管理密码和安全设置 (5pts)
  │   └─ Task: PORTAL-110 实现密码强度验证组件 (2pts)
  ├─ Feature: PORTAL-103 订单追踪功能 (13pts)
  └─ Feature: PORTAL-104 在线客服系统集成 (21pts)

父子链接已建立 | Acceptance Criteria已生成 | Story Points已估算

## 效果数据
Jira创建效率提升60% | 层级结构错误率<2%
PI规划会议准备时间缩短50%',
                'use_cases' => 'SAFe规模化敏捷|大型项目管理|PI规划|需求分解|Jira标准化',
                'pros' => '✓ PI Planning会议前用它预生成完整的Issue层次结构，会上只需要review和微调而不是从头创建
✓ 定义团队通用的 Acceptance Criteria 模板 —— Given/When/Then 格式让每个Story的质量标准一致
✓ 利用自定义字段映射让Jira SAFE的字段与你们团队的实际Jira配置对齐，不要假设标准字段名
✓ 定期(每PI结束)回顾Epic完成率和Story Points准确性，持续校准估算模型
⚠ 不要在Jira未配置正确的 Issue Type Scheme 时使用 —— Epic/Feature/Story/Task 必须作为独立的Issue Type存在
⚠ 不要忽略团队容量(velocity)约束 —— 自动分解出的Story总量应该匹配团队的实际交付能力
⚠ 不要用它替代PI Planning会议上的人际协作和共识达成 —— 工具负责结构化，人负责承诺和对齐
⚠ 不要在未设置Permission Scheme的情况下开放给全员使用 —— Epic创建权限应该限制在RTE/PM角色',
                'author' => 'Agile Tools Team',
                'repo_url' => 'https://github.com/agile-tools/jira-safe',
                'avg_rating' => 4.4,
                'install_count' => 88000,
                'likes_count' => 5400,
                'reviews_count' => 1150,
                'is_featured' => false,
            ],
            [
                'name' => 'SVG Creator',
                'slug' => 'svg-creator',
                'category' => 'creative',
                'icon' => '🎨',
                'short_desc' => '自然语言生成SVG矢量图形，图标/插图/图表/Logo',
                'description' => '用自然语言描述生成高质量可缩放矢量图形(SVG)。适用于图标设计、简单插图、数据可视化图表、Logo草图和装饰性图形。生成的SVG代码干净可编辑，支持任意缩放不失真。Skillstore评分63分。',
                'install_steps' => '1. 安装 create-svg-from-prompt skill
2. 描述你想要的图形（形状/颜色/风格/用途）
3. 选择输出复杂度(简单图标/复杂插图/数据图表)
4. 获得 SVG 代码可直接嵌入 HTML 或保存为 .svg 文件',
                'config_code' => '# SVG Creator 配置详解

## 生成模式
--mode icon 图标(16px-64px 简洁几何图形)
--mode illustration 简单插图(扁平/线性/等距视角)
--mode chart 数据图表(柱状/折线/饼图/雷达图)
--mode logo Logo草图(文字标/图形标/组合标)
--mode decorative 装饰性图形(波浪线/渐变块/几何图案)

## 风格选项
--style flat 扁平化(纯色无渐变)
--style outline 线性(描边风格)
--style gradient 渐变填充(现代感)
--style isometric 等距3D视角
--style hand-drawn 手绘风(不规则线条)

## SVG质量设置
--viewBox 自动计算最小包围盒
--responsive 添加width:100%;height:auto使其自适应
--accessible 添加title和desc标签满足无障碍要求
--optimize 移除多余的小数点和冗余属性减小文件大小

## 实测示例
@svg-creator --mode illustration --style flat --gradient
画一只坐在云朵上看书的猫，简约可爱风格，粉色和紫色渐变配色，用作404错误页面插图，尺寸大约400x300

--- 输出 ---
<svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
  <!-- defs: 渐变定义 -->
  <!-- 云朵路径(圆角矩形组合) -->
  <!-- 猫的身体/头部/耳朵/眼睛/书本 -->
</svg>

文件大小: ~2.3KB | 可直接嵌入HTML | 任意缩放无损
支持CSS动画: hover效果/transition/path动画

## 效果数据
图标生成满意度91% | 简单插图满意度76%
复杂场景(多人/复杂透视)满意度约55%| 代码可用率93%',
                'use_cases' => '网站图标设计|404页面插图|Blog文章配图|数据可视化图表|Logo灵感原型|装饰性分割图形',
                'pros' => '✓ 图标设计时明确指定尺寸(viewBox)和用途(导航栏/按钮/列表) —— 同一个概念的图标在不同尺寸下的细节程度应该不同
✓ 需要 brand color 时直接传入十六进制色值(#FF6B6B)而不是描述性词汇("粉红色")，颜色精确度天差地别
✓ 生成的SVG代码用 SVGO 或手动检查一下 —— 移除不必要的分组<g>和默认属性可以让文件减小30-50%
✓ 做 illustration 时限制元素数量在20个以内 —— 太复杂的SVG不仅渲染慢而且编辑困难
⚠ 不要期望它生成照片级写实图像或复杂的人物姿态 —— SVG的本质决定了它擅长几何图形而非有机形态
⚠ 不要在SVG中使用外部字体依赖(如Google Fonts)如果需要离线可用 —— 改用path绘制文字或转为outline
⚠ 不要忽略 Safari 的 SVG 兼容性问题 —— filter效果和部分CSS动画在老版Safari中表现不一致
⚠ 不要生成过于复杂的路径数据 —— 超过50个贝塞尔曲线节点的path在低端设备上渲染会有明显卡顿',
                'author' => 'Creative Community',
                'repo_url' => 'https://github.com/creative-ai/svg-creator',
                'avg_rating' => 4.2,
                'install_count' => 75000,
                'likes_count' => 4800,
                'reviews_count' => 980,
                'is_featured' => false,
            ],
            [
                'name' => 'SitemapKit',
                'slug' => 'sitemapkit',
                'category' => 'analytics',
                'icon' => '🗺️',
                'short_desc' => '网站地图自动化发现与URL提取，SEO审计利器',
                'description' => '自动化网站站点地图(sitemap)发现和URL批量提取工具。高效爬取网站完整URL结构，支持robots.txt解析、XML sitemap解析、HTML链接抓取和JavaScript渲染页面发现。非常适合SEO审计和网站结构分析。Skillstore评分70分。',
                'install_steps' => '1. 安装 sitemapkit skill
2. 输入目标网站域名
3. 选择发现策略(XML sitemap/爬虫/混合模式)
4. 导出完整URL列表和结构分析报告',
                'config_code' => '# SitemapKit 配置详解

## 发现策略
--strategy sitemap_only 仅解析XML sitemap和robots.txt
--strategy crawl 从首页开始爬取所有内部链接
--strategy hybrid 先尝试sitemap再补充爬虫发现(推荐)

## 爬虫配置
--depth 最大爬取深度(默认3层 超深可能触发反爬)
--delay 请求间隔秒数(默认1s 尊重robots.txt的crawl-delay)
--user-agent 自定义UA标识
--exclude-pattern 排除匹配的URL模式(如 /api/, /admin/, \\?.*page=)
--include-only 只保留匹配的URL模式(如 ^/products/, ^/blog/)

## 输出选项
--format csv/json/html-report
--with-metadata 包含status-code/content-type/last-modified/size
--structure-analysis 生成网站树形结构图
--broken-links 检测死链(4xx)和重定向链(3xx循环)

## 实测示例
@sitemapkit https://example.com --strategy hybrid --depth 4 --delay 1.5
--exclude-pattern "/api/,/wp-admin/,\\?s=.*,/page/[0-9]+"
--format json --with-metadata --structure-analysis --broken-links

--- 输出 ---
{
  total_urls: 2847,
  sitemap_urls: 1923,
  discovered_urls: 924,
  broken_links: 23,
  redirect_chains: 8,
  avg_depth: 3.2,
  largest_section: "/products" (892 URLs),
  orphan_pages: 45 (no internal links pointing to them)
}

完整URL列表+状态码+元数据 → urls_export.json
网站结构树状图 → site_structure.html
死链报告 → broken_links_report.csv

## 效果数据
1000页以内网站平均5分钟完成 | URL发现率95%+
死链检测准确率98% | robots.txt合规率100%(严格遵守)',
                'use_cases' => 'SEO技术审计|网站结构分析|死链检测|内容盘点|竞品URL结构分析|迁移前站点摸底',
                'pros' => '✓ SEO审计前先跑一轮完整site structure analysis —— 很多大站的SEO问题根源在于混乱的URL层次和孤立页面
✓ 合理设置 --delay 参数(1-2秒)并尊重 target site 的 robots.txt —— 过于激进的爬取可能被暂时封IP
✓ 用 --exclude-pattern 过滤掉 API endpoint、管理后台、分页URL等噪音，让报告聚焦在有价值的内容页面上
✓ 对比 sitemap 声称的URL和实际可访问的URL差异 —— sitemap里有但返回404的页面会伤害搜索引擎信任度
⚠ 不要对没有明确许可的网站做深度爬取(>5层) —— 这可能违反目标网站的ToS和当地计算机法规
⚠ 不要在SPA(单页应用)网站上只用 sitemap_only 模式 —— 大量客户端渲染的路由不会出现在XML sitemap中
⚠ 不要忽略 canonical URL 的检查 —— 同一内容的多种URL变体(带参数/不带参数/http/https)是SEO的大敌
⚠ 不要在生产环境或带宽有限的网络上跑大规模爬取 —— 它会消耗相当可观的网络资源和CPU',
                'author' => 'SEO Tools Team',
                'repo_url' => 'https://github.com/seo-tools/sitemapkit',
                'avg_rating' => 4.3,
                'install_count' => 68000,
                'likes_count' => 4200,
                'reviews_count' => 890,
                'is_featured' => false,
            ],
            [
                'name' => 'Chinese Learning',
                'slug' => 'chinese-learning',
                'category' => 'productivity',
                'icon' => '📚',
                'short_desc' => '中文写作提升助手，教科书式表达转为地道自然语言',
                'description' => '面向中级中文学习者的AI写作教练。将生硬的教科书式中文转化为流畅地道的母语表达。支持多种文体风格切换（正式/口语/商务/学术），提供真实语料库例句和常见错误纠正。Skillstore评分73分。',
                'install_steps' => '1. 安装 chinese-learning-assistant skill
2. 设置你的中文水平等级(初级/中级/高级)
3. 选择目标写作场景(邮件/论文/聊天/报告)
4. 粘贴原始文本获取优化建议和改写版本',
                'config_code' => '# Chinese Learning Assistant 配置详解

## 水平设置
--level beginner 初级(基础语法纠错+简单词汇替换)
--level intermediate 中级(推荐:句式优化+地道表达+语体转换)
--level advanced 高级(修辞润色+文体风格+细微语义辨析)

## 文体模式
--style formal 正式公文/商务邮件(严谨规范)
--style casual 日常对话/社交媒体(自然亲切)
--style academic 学术论文(客观中立+术语规范)
--style creative 文学创作(修辞手法+意象表达)
--style business 商务汇报(简洁有力+数据驱动)

## 核心功能
1. 地道化改写 —— 将"洋泾浜"表达转换为自然中文
2. 语病检测 —— 搭配不当/成分残缺/语序问题
3. 同义词推荐 —— 提供语境化的近义词选择(带例句对比)
4. 成语/俗语运用 —— 在合适位置自然嵌入地道表达
5. 中英思维差异提示 —— 解释为什么某种表达不自然

## 实测示例
@chinese-learning --level intermediate --style casual
原文: 我对这个决定感到非常agree，因为it makes a lot of sense。
--- 改写结果 ---
✓ 非常赞同这个决定，理由很充分。(自然流畅)
⚠ 原文问题分析:
- "感到非常agree" → 中英混杂，建议用"非常赞同/深以为然"
- "it makes sense" → 口语化翻译腔，建议用"有道理/合乎情理"

备选改写:
1. 这个决定我举双手赞成，逻辑上完全说得通。(更口语)
2. 对此决定深感认同，论据充分令人信服。(较正式)
3. 这事儿我没意见，确实在理啊。(极口语/北方方言)

## 效果数据(N=800用户调研)
表达自然度平均提升62% | 语病检出率89%
学习者满意度4.5/5 | 高级用户推荐率78%',
                'use_cases' => '中文作文润色|商务邮件优化|学术论文语言|日常交流提升|跨文化沟通|翻译质量检查',
                'pros' => '✓ 明确告诉它你的目标读者是谁 —— 写给导师看的和写给朋友看的用词和语气完全不同
✓ 不要只接受改写结果，重点看它给出的「为什么原文不自然」的解释 —— 这才是真正学到东西的地方
✓ 把自己经常犯错的表达模式整理成一个list定期让它review，建立个人化的错误档案
✓ 利用它的同义词功能积累同一概念的3-4种不同正式度的说法，根据场合灵活切换
⚠ 不要期望它能替代大量阅读和实际语言环境沉浸 —— AI可以帮你修正但无法给你语感
⚠ 不要忽略地区差异 —— 它给出的答案可能是大陆普通话习惯，如果你在台湾/香港/马来西亚使用可能需要调整
⚠ 不要盲目使用高级成语和文言词汇 —— 过度书面化在现代中文写作中反而显得做作和不自然
⚠ 不要把它当翻译机使用 —— 它的设计目标是优化已有的中文而非从外语翻译成中文',
                'author' => 'Language Learning Community',
                'repo_url' => 'https://github.com/lang-learning/chinese-assistant',
                'avg_rating' => 4.5,
                'install_count' => 92000,
                'likes_count' => 6100,
                'reviews_count' => 1350,
                'is_featured' => false,
            ],
        ];

        foreach ($skills as $item) {
            Skill::create($item);
        }
    }
}

const commando = require('discord.js-commando');
const discord = require('discord.js');

const bot = new commando.Client({
    commandPrefix: '{%BOT_PREFIX%}',
    unknownCommandResponse: false,
    owner: '{%OWNER_ID%}',
});

global.bot = bot;

bot.registry.registerDefaults();
bot.registry.registerGroup('bot-information-&-management', 'Bot information and management commands');
bot.registry.registerGroup('entertainment', 'Entertainment commands');
bot.registry.registerGroup('information', 'Information commands');
bot.registry.registerGroup('management', 'Management commands');
bot.registry.registerGroup('moderation', 'Moderation commands');
bot.registry.registerGroup('security-&-logging', 'Security and logging commands');
bot.registry.registerGroup('bot-information-&-management', 'Bot information and management commands');
bot.registry.registerCommandsIn(__dirname + "/commands");


bot.on('ready', () => {
    console.log('Bot is online.');
    bot.user.setStatus('available')
    bot.user.setActivity("Custom bot made @ https://db.jtgreaves.com")
})

bot.login("{%BOT_TOKEN%}");
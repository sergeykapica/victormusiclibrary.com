<audio width="100%" id="audio-player">
    <source src="<?=$arParams['AUDIO_URL'];?>" type="audio/mpeg">
    <object width="640" height="40" type="application/x-shockwave-flash" data="/local/components/my_context/player/flash/victormusiclibraryAudioPlayer.swf">
        <param name="movie" value="/local/components/my_context/player/flash/victormusiclibraryAudioPlayer.swf">
        <param name="flashvars" value="file=<?=$arParams['AUDIO_URL'];?>">
    </object>
</audio>

<script src="/local/components/my_context/player/js/mediaelement-and-player.min.js"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        window.audioPlayer = new MediaElementPlayer(
            $('#audio-player')[0],
            {
                features: ['playpause','progress','volume']
            }
        );
    });
</script>
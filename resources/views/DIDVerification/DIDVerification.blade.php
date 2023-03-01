@extends('layout_files.layout')


@section('content')




        <div >
            <header class="header">
                <meta name="viewport" content="width=device-width, initial-scale=0.5" />
                <StyledHeader>
                <nav id="header" class="headernav">
                    <div class="logo-desktop">
                        <img src="/images/IAMX_Logo_blue.png" class="headerimg" />

                    </div>
                    <div class='sideBarText'>
                        <a onClick={() => scrollToElement("view-getStarted")}>Get started</a>
                    </div>
                    <div class='sideBarText'>
                        <a onClick={() => scrollToElement("view-contactus")}>Contact us</a>
                    </div>
                </nav>

                </StyledHeader>


            </header>

            @if(count($errors)>0)
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                        {{error}}
                    @endforeach
                </div>
            @endif

            @if (Session::has('errors'))
                {{Session::get('errors')}}
            @endif


            <div class="wrapper">
                <div class="container">

                <section class="section" id="view-getStarted"></section>
                    <div class="headerform">
                        <img src="/images/IAMX_Logo_blue.png" alt="IAMX Logo" />
                        <h1>Check your NFT Identity</h1>
                        <form action="{{url('/didverification')}}" class="inline" method="post" enctype='multipart/form-data'>
                            @csrf
                            <input value="{{isset($input->policyid)? $input-> policyid : old('policyid')}}" name='policyid' id='policyid' placeholder="Enter PolicyID or IPFS Hash"/>
                            <button type="submit" >Check</button>
                        </form>

                    </div>
                    <div class="inline found">
                        <h2>Verifications Found</h2>
                    </div>

                    <div class="btn-grid">

                        <a href=null}>
                            <button class="gridItem">
                                <img src="/images/social-button/twitter.png" width="20" height="20" />

                                <span class='buttonText'>
                                    {{isset($policyId->accounts->twitter)?'yes':'Twitter'}}
                                </span>
                                {checkAccounts(accounts, 'twitter') ?
                                    <div class='check'>
                                        <img src="/images/check.png" width="20" height="20" />
                                    </div> :
                                    <></>
                                }
                            </button>
                        </a>


                        <a href= null}>
                            <button class= "gridItem" >
                                <img src="/images/social-button/facebook.png" width="20" height="20" />
                                <span class='buttonText'>
                                    {accounts.includes("facebook") ? accounts.find(element => element.username !== undefined).username : 'Facebook'}
                                </span>
                                {checkAccounts(accounts, 'facebook') ?
                                    <div class='check'>
                                        <img src="/images/check.png" width="20" height="20" />
                                    </div> :
                                    <></>
                                }
                            </button>
                        </a>

                        <a href= null}>
                            <button class="gridItem" >
                                <img src="/images/social-button/discord.png" width="20" height="20" />
                                <span class='buttonText'>
                                    {accounts.includes("discord") ? accounts.find(element => element.discordId !== undefined).username : 'Discord'}
                                </span>
                                {checkAccounts(accounts, 'discord') ?
                                    <div class='check'>
                                        <img src="/images/check.png" width="20" height="20" />
                                    </div> :
                                    <></>
                                }
                            </button>
                        </a>

                        <a href=null}>
                            <button class="gridItem"}>
                                <img src="/images/social-button/github.png" width="20" height="20" />
                                <span class='buttonText'>
                                    {accounts.includes("github") ? accounts.find(element => element.githubId !== undefined).username : 'Github'}
                                </span>
                                {checkAccounts(accounts, 'github') ?
                                    <div class='check'>
                                        <img src="/images/check.png" width="20" height="20" />
                                    </div> :
                                    <></>
                                }
                            </button>
                        </a>

                        <a href=null}>
                            <button class="gridItem">
                                <img src="/images/social-button/apple.png" width="20" height="20" />
                                <span class='buttonText'>
                                    {accounts.includes("apple") ? accounts.find(element => element.username !== undefined).username : 'Apple'}
                                </span>
                                {checkAccounts(accounts, 'apple') ?
                                    <div class='check'>
                                        <img src="/images/check.png" width="20" height="20" />
                                    </div> :
                                    <></>
                                }
                            </button>
                        </a>

                        <a href=null}>
                            <button class="gridItem">
                                <img src="/images/social-button/linkedin.png" width="20" height="20" />
                                <span class='buttonText'>
                                    {accounts.includes("linkedin") ? accounts.find(element => element.linkedinId !== undefined).username : 'Linkedin'}
                                </span>
                                {checkAccounts(accounts, 'linkedin') ?
                                    <div class='check'>
                                        <img src="/images/check.png" width="20" height="20" />
                                    </div> :
                                    <></>
                                }
                            </button>
                        </a>

                        <a href={accounts.length !== 0 && accounts.includes("twitch") ? `https://twitch.tv/${(accounts.find(element => element.username !== undefined).username)}` : null}>
                            <button class={accounts.length === 0 || accounts.includes("twitch") ? "gridItem" : "greyGridItem"}>
                                <img src="/images/social-button/twitch.png" width="20" height="20" />
                                <span class='buttonText'>
                                    {accounts.includes("twitch") ? accounts.find(element => element.twitchId !== undefined).username : 'Twitch'}
                                </span>
                                {checkAccounts(accounts, 'twitch') ?
                                    <div class='check'>
                                        <img src="/images/check.png" width="20" height="20" />
                                    </div> :
                                    <></>
                                }
                            </button>
                        </a>


                        <a href={accounts.length !== 0 && accounts.includes("tiktok") ? `https://tiktok/${(accounts.find(element => element.username !== undefined).username)}` : null}>
                            <button class={accounts.length === 0 || accounts.includes("tiktok") ? "gridItem" : "greyGridItem"}>
                                <img src="/images/social-button/tiktok.png" width="20" height="20" />
                                <span class='buttonText'>
                                    {accounts.includes("tiktok") ? accounts.find(element => element.tiktokId !== undefined).username : 'Tiktok'}
                                </span>
                                {checkAccounts(accounts, 'tiktok') ?
                                    <div class='check'>
                                        <img src="/images/check.png" width="20" height="20" />
                                    </div> :
                                    <></>
                                }
                            </button>
                        </a>

                        {/* <a href=null}>
                            <button class="greyGridItem">
                                <img src="/images/social-button/tiktok.png" width="20" height="20" />
                                <span class='buttonText'>

                                </span>
                                {checkAccounts(accounts, 'KYC') ?
                                    <div class='check'>
                                        <img src="/images/check.png" width="20" height="20" />
                                    </div> :
                                    <></>
                                }
                            </button>
                        </a> */}


                        <div class="showArea">
                            <input type="checkbox" id="showMore" class="checkbox" />
                            <div class="showMore">

                            </div>
                            <br />
                            <label htmlFor="showMore">
                                <div class="dividerMore">
                                    <hr width="90%" />
                                    <b>Show all &or;</b>
                                </div>
                                <div class="dividerLess">
                                    <hr width="90%" />
                                    <b>Show less &and;</b>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="payload">
                        <form>
                            <textarea id="did" class="textArea" value={JSON.stringify(payload, undefined, 4)} readOnly />
                        </form>
                    </div>

                    <div class="createIdentity">
                        <h1>Want to create an NFT Identity?</h1>
                        <p>By creating your NFT Identity you can verify your identity and prove creative ownership over NFT within
                            seconds - and you always stay in control of your data.</p>
                        <a href="https://nftidentity.iamx.id/"><button>Create NFT Identity</button></a>
                    </div>
                </div>

            </div>
        </div>

        <script>
            function scrollToElement(elementId) {
                document.getElementById(elementId)?.scrollIntoView({
                behavior: "smooth",
                inline: "nearest",
                });
            }
        </script>

@endsection



